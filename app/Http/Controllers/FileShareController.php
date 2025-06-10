<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\FileShare;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Smalot\PdfParser\Parser;

class FileShareController extends Controller
{
    // Affiche la liste des fichiers
    public function index()
    {
        // Filtrer : affiche seulement les fichiers de l’utilisateur SAUF si admin
        if (auth()->user()->is_admin) {
            $files = FileShare::orderBy('created_at', 'desc')->paginate(10);
        } else {
            $files = FileShare::where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }
        return view('files.index', compact('files'));
    }

    // Upload d'un fichier
    public function upload(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:pdf,doc,docx,txt,jpg,png|max:10240', // 25 Mo max
    ]);

    $uploaded = $request->file('file');
    $filename = time() . '_' . $uploaded->getClientOriginalName();
    // On stocke dans le disque 'private' au lieu de 'public'
    $path = $uploaded->storeAs('', $filename, 'private');

    FileShare::create([
        'filename' => $uploaded->getClientOriginalName(),
        'path'     => $path,
        'user_id'  => auth()->id(),
    ]);

    return redirect()->route('files.index')->with('success', 'Fichier téléchargé !');
}


    // Téléchargement sécurisé
    public function download($id)
    {
    $file = FileShare::findOrFail($id);

    // Vérifie l'accès : propriétaire OU admin
    if ($file->user_id !== auth()->id() && !auth()->user()->is_admin) {
        abort(403, "Vous n'êtes pas autorisé à télécharger ce fichier.");
    }

    // On utilise le disque 'private' !
    return Storage::disk('private')->download($file->path, $file->filename);
    }


    // Suppression sécurisée
    public function analyze($id)
{
    $file = File::findOrFail($id);

    // Vérifie que l'utilisateur a le droit d'analyser ce fichier (sécurité)
    if ($file->user_id !== Auth::id() && !Auth::user()->is_admin) {
        abort(403, 'Accès interdit');
    }

    // Chemin complet du fichier PDF
    $filePath = storage_path('app/private/' . $file->path);

    // Extraction texte
    $parser = new Parser();
    $pdf    = $parser->parseFile($filePath);
    $text   = $pdf->getText();

    // ... (suite de l’analyse OpenAI à venir)
}

    // Analyse sécurisée
    public function analyze($id)
    {
        $file = FileShare::findOrFail($id);

        // Vérifie si propriétaire OU admin
        if ($file->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403, "Vous n'êtes pas autorisé à analyser ce fichier.");
        }

        // Récupère le chemin absolu du fichier stocké
        $filePath = Storage::disk('private')->path($file->path);
        $text = null;

        // Gestion selon l'extension du fichier
        if (Str::endsWith($file->filename, '.txt')) {
            $text = file_get_contents($filePath);
        } elseif (Str::endsWith($file->filename, '.pdf')) {
            // Utilise Smalot\PdfParser
            try {
                $parser = new \Smalot\PdfParser\Parser();
                $pdf = $parser->parseFile($filePath);
                $text = $pdf->getText();
            } catch (\Exception $e) {
                return back()->with('error', 'Impossible de lire ce PDF.');
            }
        } else {
            return back()->with('error', 'Ce type de fichier n’est pas encore supporté.');
        }

        // Sécurise la taille envoyée à OpenAI (tu peux tronquer si besoin)
        $text = mb_substr($text, 0, 3000); // <= 3000 caractères pour éviter la limite

        // Appel API OpenAI
        $apiKey = env('OPENAI_API_KEY');
        $response = Http::withToken($apiKey)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => "Voici le contenu d'un fichier :\n\n$text\n\nPeux-tu le résumer en quelques phrases ?"],
                ],
                'max_tokens' => 400,
            ]);

        $body = $response->json();
        $answer = $body['choices'][0]['message']['content'] ?? 'Pas de réponse.';

        return view('files.analyze', [
            'file' => $file,
            'analysis' => $answer,
        ]);
    }
}

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
            'file' => 'required|file|mimes:pdf,doc,docx,txt,jpg,png|max:10240',
        ]);

        $uploaded = $request->file('file');
        $filename = time() . '_' . $uploaded->getClientOriginalName();
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

        if ($file->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403, "Vous n'êtes pas autorisé à télécharger ce fichier.");
        }

        return Storage::disk('private')->download($file->path, $file->filename);
    }

    // Analyse sécurisée et extraction structurée via OpenAI
    public function analyze($id)
    {
        $file = FileShare::findOrFail($id);

        if ($file->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403, "Vous n'êtes pas autorisé à analyser ce fichier.");
        }

        // Si l'analyse existe déjà, l'afficher directement
        if ($file->analysis_json) {
            $extracted = json_decode($file->analysis_json, true);
            $answer = $file->analysis_raw ?? '';
            return view('files.analyze', [
                'file' => $file,
                'analysis' => $answer,
                'extracted' => $extracted,
            ]);
        }

        // Extraction du texte du fichier
        $filePath = Storage::disk('private')->path($file->path);
        $text = null;

        if (Str::endsWith($file->filename, '.txt')) {
            $text = file_get_contents($filePath);
        } elseif (Str::endsWith($file->filename, '.pdf')) {
            try {
                $parser = new Parser();
                $pdf = $parser->parseFile($filePath);
                $text = $pdf->getText();
            } catch (\Exception $e) {
                return back()->with('error', 'Impossible de lire ce PDF.');
            }
        } else {
            return back()->with('error', 'Ce type de fichier n’est pas encore supporté.');
        }

        $text = mb_substr($text, 0, 3000); // Limite la taille envoyée à OpenAI

        // Appel API OpenAI
        $apiKey = env('OPENAI_API_KEY');
        if (!$apiKey) {
            return back()->with('error', 'Clé API OpenAI manquante.');
        }

        $prompt = "Voici le contenu d'un document immobilier.\n\n$text\n\n"
            . "Peux-tu extraire les informations suivantes et les présenter sous forme de JSON : "
            . "prix, superficie, localisation, nombre de pièces, type de bien, et toute autre info pertinente ? "
            . "Format attendu : {\"prix\":..., \"superficie\":..., \"localisation\":..., \"nombre_pieces\":..., \"type_bien\":..., \"autres_infos\":...}";

        try {
            $response = Http::withToken($apiKey)
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'max_tokens' => 400,
                ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur de connexion à OpenAI: '.$e->getMessage());
        }

        if ($response->failed()) {
            return back()->with('error', $response->json()['error']['message'] ?? 'Erreur OpenAI');
        }

        $body = $response->json();
        $answer = $body['choices'][0]['message']['content'] ?? 'Pas de réponse.';

        // Décodage du JSON OpenAI
        $extracted = null;
try {
    $extracted = json_decode($answer, true);
    // Si $extracted est encore null, on tente un nettoyage simple
    if (!$extracted) {
        $jsonStart = strpos($answer, '{');
        if ($jsonStart !== false) {
            $jsonString = substr($answer, $jsonStart);
            $extracted = json_decode($jsonString, true);
        }
    }
} catch (\Exception $e) {
    $extracted = null;
}

        // Enregistre le résultat de l'analyse en BDD
        $file->analysis_json = $extracted ? json_encode($extracted) : null;
        $file->analysis_raw = $answer;
        $file->save();
        


        return view('files.analyze', [
            'file' => $file,
            'analysis' => $answer,
            'extracted' => $extracted,
        ]);
    }
}

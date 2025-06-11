<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\MessageAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Smalot\PdfParser\Parser;

class ConversationController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin) {
            $conversations = Conversation::orderBy('created_at', 'desc')->paginate(10);
        } else {
            $conversations = Conversation::where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }
        return view('conversations.index', compact('conversations'));
    }

    public function create()
    {
        return view('conversations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Conversation::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
        ]);

        return redirect()->route('conversations.index')->with('success', 'Conversation créée');
    }

    public function show($id)
    {
        $conversation = Conversation::findOrFail($id);

        if ($conversation->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403);
        }

        $messages = $conversation->messages()->with('user', 'attachments')->orderBy('created_at')->get();

        return view('conversations.show', compact('conversation', 'messages'));
    }

    public function storeMessage(Request $request, $id)
    {
        $conversation = Conversation::findOrFail($id);

        if ($conversation->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403);
        }

        $request->validate([
            'content' => 'required|string',
            'attachments.*' => 'file|mimes:pdf,doc,docx,txt,jpg,png|max:10240',
        ]);

        $message = $conversation->messages()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('', $filename, 'private');
                $message->attachments()->create([
                    'filename' => $file->getClientOriginalName(),
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('conversations.show', $conversation->id);
    }

    public function analyzeAttachment($id)
    {
        $attachment = MessageAttachment::findOrFail($id);
        $conversation = $attachment->message->conversation;

        if ($conversation->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403);
        }

        if ($attachment->analysis_json) {
            $extracted = json_decode($attachment->analysis_json, true);
            $answer = $attachment->analysis_raw ?? '';
            return view('conversations.analyze', [
                'attachment' => $attachment,
                'analysis' => $answer,
                'extracted' => $extracted,
            ]);
        }

        $filePath = Storage::disk('private')->path($attachment->path);
        $text = null;

        if (Str::endsWith($attachment->filename, '.txt')) {
            $text = file_get_contents($filePath);
        } elseif (Str::endsWith($attachment->filename, '.pdf')) {
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

        $text = mb_substr($text, 0, 3000);

        $apiKey = env('OPENAI_API_KEY');
        if (!$apiKey) {
            return back()->with('error', 'Clé API OpenAI manquante.');
        }

        $prompt = "Voici le contenu d'un document.\n\n$text\n\nPeux-tu en faire un résumé ?";

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

        $extracted = null;
        try {
            $extracted = json_decode($answer, true);
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

        $attachment->analysis_json = $extracted ? json_encode($extracted) : null;
        $attachment->analysis_raw = $answer;
        $attachment->save();

        return view('conversations.analyze', [
            'attachment' => $attachment,
            'analysis' => $answer,
            'extracted' => $extracted,
        ]);
    }
}

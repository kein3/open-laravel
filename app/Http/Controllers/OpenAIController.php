<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OpenAIController extends Controller
{
    public function index()
{
    return view('openai.index');
}

    public function send(Request $request)
{
    $request->validate([
        'prompt' => 'required|string|max:1000',
    ]);

    $apiKey = env('OPENAI_API_KEY');
    if (!$apiKey) {
        return back()->withErrors(['openai' => 'Clé API OpenAI manquante.']);
    }

    try {
        $response = \Illuminate\Support\Facades\Http::withToken($apiKey)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $request->prompt],
                ],
                'max_tokens' => 300,
            ]);
    } catch (\Exception $e) {
        return back()->withErrors(['openai' => 'Erreur de connexion à OpenAI: '.$e->getMessage()]);
    }

    if ($response->failed()) {
        // Affiche le vrai message d’erreur OpenAI
        return back()->withErrors(['openai' => $response->json()['error']['message'] ?? 'Erreur OpenAI']);
    }

    $body = $response->json();
    $answer = $body['choices'][0]['message']['content'] ?? 'Pas de réponse';

    return view('openai.index', [
        'prompt' => $request->prompt,
        'answer' => $answer,
    ]);
}

}

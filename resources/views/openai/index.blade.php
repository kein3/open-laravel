@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Mini-dashboard OpenAI (Playground)</h1>

    @if ($errors->has('openai'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-4">
        {{ $errors->first('openai') }}
    </div>
@endif

    <form action="{{ route('openai.send') }}" method="POST" class="mb-6">
        @csrf
        <textarea name="prompt" rows="4" class="border p-2 w-full" placeholder="Écris ton prompt ici..." required>{{ old('prompt', $prompt ?? '') }}</textarea>
        @error('prompt')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded mt-2">Envoyer à OpenAI</button>
    </form>

    @isset($answer)
        <div class="bg-gray-100 border p-4 rounded">
            <h2 class="font-medium mb-2">Réponse :</h2>
            <p class="whitespace-pre-line">{{ $answer }}</p>
        </div>
    @endisset
</div>
@endsection

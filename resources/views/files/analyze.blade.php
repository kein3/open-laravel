@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Analyse OpenAI du fichier : {{ $file->filename }}</h1>

    <div class="mb-4">
        <strong>Résumé/Analyse :</strong>
        <div class="bg-gray-100 p-3 rounded mt-2">
            {{ $analysis }}
        </div>
    </div>

    <a href="{{ route('files.index') }}" class="text-blue-600 hover:underline">Retour aux fichiers</a>
</div>
@endsection

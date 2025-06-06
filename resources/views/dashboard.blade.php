@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <div class="bg-white rounded-xl shadow p-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">Bonjour, {{ Auth::user()->name }} !</h1>
            <p class="text-gray-500 mt-1">Bienvenue sur votre espace intranet.</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('files.index') }}" class="btn-noir">Mes fichiers</a>
            <a href="{{ route('openai.index') }}" class="btn-noir">OpenAI Playground</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gray-50 rounded-lg shadow p-5 text-center">
            <div class="text-3xl font-bold">{{ $fileCount }}</div>
            <div class="text-gray-600">Fichiers partagés</div>
        </div>
        <div class="bg-gray-50 rounded-lg shadow p-5 text-center">
            <div class="text-3xl font-bold">{{ $userCount }}</div>
            <div class="text-gray-600">Utilisateurs</div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6 mt-4">
        <h2 class="text-lg font-semibold mb-3">Derniers fichiers partagés</h2>
        <ul>
            @forelse($lastFiles as $file)
                <li class="flex justify-between items-center border-b last:border-0 py-2">
                    <span>{{ $file->filename }}</span>
                    <a href="{{ route('files.download', $file->id) }}" class="btn-noir">Télécharger</a>
                </li>
            @empty
                <li class="text-gray-500">Aucun fichier partagé pour le moment.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="space-y-8">
    {{-- Bloc de bienvenue et raccourcis --}}
    <div class="bg-white rounded-2xl shadow-md p-8 flex flex-col sm:flex-row justify-between items-center mb-8">
        <div class="mb-4 sm:mb-0 text-center sm:text-left">
            <h1 class="text-3xl font-extrabold mb-1 text-gray-900">Bonjour, {{ Auth::user()->name }} !</h1>
            <p class="text-gray-500 text-lg">Bienvenue sur votre espace intranet.</p>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('files.index') }}" class="btn-noir">Mes fichiers</a>
            <a href="{{ route('openai.index') }}" class="btn-noir">OpenAI Playground</a>
        </div>
    </div>

    {{-- Bloc KPIs --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <div class="bg-gray-50 rounded-2xl shadow-sm p-7 text-center flex flex-col items-center h-40">
            <div class="text-5xl font-extrabold mb-1 text-gray-900">{{ $fileCount }}</div>
            <div class="text-gray-600 text-sm uppercase tracking-wide">Fichiers partagés</div>
        </div>
        <div class="bg-gray-50 rounded-2xl shadow-sm p-7 text-center flex flex-col items-center h-40">
            <div class="text-5xl font-extrabold mb-1 text-gray-900">{{ $userCount }}</div>
            <div class="text-gray-600 text-sm uppercase tracking-wide">Utilisateurs</div>
        </div>
        {{-- Si tu ajoutes d’autres KPIs plus tard, copie-colle ce bloc et conserve h-40 pour l’uniformité --}}
    </div>

    {{-- Bloc “Derniers fichiers partagés” --}}
    <div class="bg-white rounded-2xl shadow-md p-8 mt-8">
        <h2 class="text-xl font-semibold mb-5 text-gray-900">Derniers fichiers partagés</h2>
        <ul>
            @forelse($lastFiles as $file)
                <li class="
                    flex flex-col sm:flex-row 
                    justify-between items-start sm:items-center 
                    bg-gray-100 rounded-xl p-4 mb-3 shadow-sm 
                    hover:bg-white hover:shadow-md 
                    transition duration-150
                ">
                    <span class="truncate text-gray-800">{{ $file->filename }}</span>
                    <a href="{{ route('files.download', $file->id) }}" class="btn-noir mt-3 sm:mt-0">Télécharger</a>
                </li>
            @empty
                <li class="text-gray-500">Aucun fichier partagé pour le moment.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection

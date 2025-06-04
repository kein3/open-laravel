@extends('layout')

@section('title', 'Accueil')

@section('body')
<div class="max-w-4xl mx-auto p-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Bienvenue sur votre intranet</h1>
    <p class="text-lg text-gray-600 mb-6">Jean Dupont - Responsable projet</p>

    <h2 class="text-2xl font-semibold text-gray-700 mb-2">Activité récente</h2>
    <ul class="list-disc list-inside text-gray-700 space-y-1">
        <li>Création du projet "Alpha"</li>
        <li>Message de l'équipe Marketing</li>
        <li>Mise à jour du planning</li>
    </ul>
</div>
@endsection

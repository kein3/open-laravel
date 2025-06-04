@extends('layout')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Bienvenue sur votre intranet</h1>
    <div class="bg-white p-4 rounded shadow mb-6">
        Jean Dupont - Responsable projet
    </div>
    <h2 class="text-xl font-semibold mb-2">Activité récente</h2>
    <ul class="space-y-2">
        <li class="bg-white p-3 rounded shadow">Création du projet "Alpha"</li>
        <li class="bg-white p-3 rounded shadow">Message de l'équipe Marketing</li>
        <li class="bg-white p-3 rounded shadow">Mise à jour du planning</li>
    </ul>
@endsection

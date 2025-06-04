@extends('layout')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Tableau de bord</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded shadow">
            <p class="text-gray-500">Projets en cours</p>
            <p class="text-3xl font-bold">5</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-gray-500">Messages non lus</p>
            <p class="text-3xl font-bold">12</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-gray-500">Tâches à faire</p>
            <p class="text-3xl font-bold">8</p>
        </div>
    </div>
@endsection

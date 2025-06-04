@extends('layout')

@section('title', 'Accueil')

@section('content')
    <div class="container mx-auto py-16 text-center">
        <h1 class="text-4xl font-bold mb-4 text-gray-800">Bienvenue sur MonApp</h1>
        <p class="text-gray-600 mb-8">
            Votre application Laravel propulsée par Tailwind CSS.
        </p>
        <a
            href="{{ route('dashboard') }}"
            class="inline-block px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700"
        >
            Accéder au tableau de bord
        </a>
    </div>
@endsection

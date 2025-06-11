<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'HoliProject') }}</title>

    <!-- Assets CSS/JS du build Vite -->
    <link rel="stylesheet" href="/build/assets/app-DvP21T2e.css">
    <script type="module" src="/build/assets/app-Bf4POITK.js"></script>

    <!-- Icônes Google Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-72 bg-white border-r border-gray-200 flex flex-col px-6 py-8 shadow-lg">
        <h1 class="text-2xl font-extrabold mb-8 text-gray-900">{{ config('app.name', 'HoliProject') }}</h1>

        <!-- Nom utilisateur seulement -->
        <div class="flex flex-col items-center text-center mb-10">
            <h2 class="text-lg font-semibold">{{ auth()->user()->name }}</h2>
        </div>

        <!-- Navigation -->
        <nav class="flex-1">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-green-100 text-green-700 font-semibold' : 'hover:bg-gray-100' }}">
                        <span class="material-symbols-outlined text-lg">home</span> Accueil
                    </a>
                </li>
                <li>
                    <a href="{{ route('files.index') }}"
                       class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('files.index') ? 'bg-green-100 text-green-700 font-semibold' : 'hover:bg-gray-100' }}">
                        <span class="material-symbols-outlined text-lg">folder</span> Fichiers
                    </a>
                </li>
                {{-- Ajoute d’autres liens ici si besoin --}}
            </ul>
        </nav>

        <!-- Déconnexion -->
        <form action="{{ route('logout') }}" method="POST" class="mt-8">
            @csrf
            <button class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 transition text-sm">
                Déconnexion
            </button>
        </form>
    </aside>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col">
        <!-- Header supprimé (plus de barre de recherche) -->

        <main class="flex-1 px-8 py-10">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>

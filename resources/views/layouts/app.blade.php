<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'HoliProject') }}</title>

    <!-- Assets CSS/JS du build Vite -->
    <link rel="stylesheet" href="/build/assets/app-DvP21T2e.css"> {{-- Mets ici ton vrai nom CSS buildé --}}
    <script type="module" src="/build/assets/app-Bf4POITK.js"></script>

    <!-- Icônes Google Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body 

class="bg-gray-50 text-gray-900 antialiased">
<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-72 bg-white border-r border-gray-200 flex flex-col px-6 py-8 shadow-lg">
        <h1 class="text-2xl font-extrabold mb-8 text-gray-900">{{ config('app.name', 'HoliProject') }}</h1>

        <div class="flex flex-col items-center text-center mb-10">
            <div class="rounded-full bg-gray-200 w-24 h-24 flex items-center justify-center text-3xl font-bold">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <h2 class="mt-4 font-semibold">{{ auth()->user()->name }}</h2>
            <p class="text-xs text-gray-500">Utilisateur interne</p>
            <div class="flex gap-6 mt-4 text-sm">
                <div>
                    <span class="font-bold text-gray-800">527</span><br><span class="text-gray-400">Points</span>
                </div>
                <div>
                    <span class="font-bold text-gray-800">378</span><br><span class="text-gray-400">Abonnés</span>
                </div>
            </div>
        </div>

        <nav class="flex-1">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-green-100 text-green-700 font-semibold' : 'hover:bg-gray-100' }}">
                        <span class="material-symbols-outlined text-lg">home</span> Home
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

        <div class="mt-10">
            <h3 class="text-sm font-semibold text-gray-600 mb-3">Meetings</h3>
            <div class="bg-gray-100 rounded-xl p-4 text-xs space-y-2">
                <div class="flex justify-between">
                    <span class="font-medium">Meeting 1</span>
                    <span class="text-green-600 font-semibold">today</span>
                    <span>R678</span>
                </div>
                <div class="flex justify-between text-gray-500">
                    <span>Meeting 2</span><span>13 feb</span><span>R23</span>
                </div>
                <div class="flex justify-between text-gray-500">
                    <span>Meeting 3</span><span>5 mar</span><span>R098</span>
                </div>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="mt-8">
            @csrf
            <button class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 transition text-sm">
                Déconnexion
            </button>
        </form>
    </aside>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col">
        <header class="h-16 bg-white border-b border-gray-200 flex items-center px-8">
            <div class="relative w-full max-w-md">
                <input type="text" placeholder="Rechercher…"
                       class="w-full pl-10 pr-4 py-2 bg-gray-100 rounded-full focus:outline-none">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
            </div>
        </header>

        <main class="flex-1 px-8 py-10">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>

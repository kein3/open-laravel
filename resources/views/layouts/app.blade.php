<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'HoliProject') }}</title>

    <!-- Assets compilés pour la prod -->
    <link rel="stylesheet" href="/build/assets/app-DlrseeeD.css">
    <script type="module" src="/build/assets/app-Bf4POITK.js"></script>
</head>
<body class="bg-gray-100 text-gray-900 antialiased">
  {{-- BLA BLA LAYOUT OK --}}
    
    {{-- Exemple de navbar --}}
    <nav class="bg-white border-b border-gray-200 px-4 py-3">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div>
            <a href="{{ route('dashboard') }}" class="font-bold mr-4">Accueil</a>
            <a href="{{ route('files.index') }}" class="mr-4">Fichiers</a>
        </div>
        <div>
            @auth
                <span class="mr-4">{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button class="text-red-600 hover:underline">Déconnexion</button>
                </form>
            @endauth
        </div>
    </div>
</nav>


    <main class="py-6">
        @yield('content')
    </main>
</body>
</html>

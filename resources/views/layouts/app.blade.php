<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'HoliProject') }}</title>
    <link rel="stylesheet" href="/build/assets/app-DlrseeeD.css"> {{-- met ici ton vrai nom CSS buildé --}}
    <script type="module" src="/build/assets/app-Bf4POITK.js"></script>
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
    <nav class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-20">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-4 py-2">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-blue-700 hover:text-blue-900 transition">HoliProject</a>
                <a href="{{ route('files.index') }}" class="text-blue-600 hover:text-blue-800">Fichiers</a>
                <!-- Ajoute d'autres liens ici -->
            </div>
            <div class="flex items-center gap-2">
                @auth
                    <span class="text-sm mr-2">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button class="text-red-500 hover:underline text-sm">Déconnexion</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>
    <main class="py-8 px-2 min-h-screen">
        @yield('content')
    </main>
    <footer class="text-center text-xs text-gray-500 py-6">© {{ date('Y') }} HoliProject</footer>
</body>
</html>

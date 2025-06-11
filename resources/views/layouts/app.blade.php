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
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between py-8 px-6 shadow-md">
            <div>
                <div class="flex items-center gap-2 mb-8">
                    <span class="bg-blue-600 text-white text-xl font-bold rounded-lg px-3 py-1">HoliProject</span>
                </div>
                <nav class="flex flex-col gap-2">
                    <a href="{{ route('dashboard') }}"
                       class="py-2 px-3 rounded-lg hover:bg-blue-50 {{ request()->routeIs('dashboard') ? 'bg-blue-100 font-semibold text-blue-700' : 'text-gray-700' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('files.index') }}"
                       class="py-2 px-3 rounded-lg hover:bg-blue-50 {{ request()->routeIs('files.index') ? 'bg-blue-100 font-semibold text-blue-700' : 'text-gray-700' }}">
                        Fichiers
                    </a>
                    {{-- Ajoute d'autres liens ici si besoin --}}
                </nav>
            </div>
            <div class="flex items-center gap-2 mt-8">
                @auth
                    <div class="rounded-full bg-blue-600 w-10 h-10 flex items-center justify-center text-white font-bold text-lg uppercase">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="text-sm">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline ml-2">
                        @csrf
                        <button class="text-red-500 hover:underline text-sm px-2 py-1">Déconnexion</button>
                    </form>
                @endauth
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <main class="py-10 px-6 flex-1">
                @yield('content')
            </main>
            <footer class="text-center text-xs text-gray-500 py-4">© {{ date('Y') }} HoliProject</footer>
        </div>
    </div>
</body>

</html>

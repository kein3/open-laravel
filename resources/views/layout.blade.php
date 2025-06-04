<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Holi Intranet</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <header class="bg-white shadow p-4 flex items-center">
        <svg class="h-6 w-6 text-blue-500" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M12 2a10 10 0 100 20 10 10 0 000-20z" />
        </svg>
        <span class="ml-2 text-xl font-semibold">Holi Intranet</span>
    </header>
    <div class="flex min-h-screen">
        <aside class="w-64 bg-white shadow-md hidden md:block">
            <nav class="mt-6">
                <a href="{{ url('/') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Accueil</a>
                <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
                <a href="{{ url('/messages') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Messages</a>
                <a href="{{ url('/profil') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil</a>
            </nav>
        </aside>
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>

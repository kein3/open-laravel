<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Dashboard')</title>

    {{-- CSS & JS compilés par Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    @include('partials.nav')

    <main class="p-6">
        @yield('content')
    </main>
 @stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- CSS compilé par Tailwind CLI -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
  </head>

  <body class="bg-gray-50 text-gray-800 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
      @include('layouts.navigation')

      <main class="flex-1 flex items-center justify-center">
        <div class="w-full max-w-3xl p-6 sm:p-10">
          @yield('content')
        </div>
      </main>
    </div>
  </body>
</html>

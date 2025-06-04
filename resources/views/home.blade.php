<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accueil</title>
</head>
<body>
    <h1>Bienvenue sur notre application !</h1>
    <a href="{{ url('/contact') }}">
        <button>Contact</button>
    </a>
</body>
</html>

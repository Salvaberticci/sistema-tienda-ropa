<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Hechizos Diseños y Complementos') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-beige-800 antialiased min-h-screen bg-gradient-to-br from-beige-100 via-beige-50 to-white">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="absolute inset-0 bg-grid-pattern pointer-events-none"></div>
            <div class="absolute top-20 left-20 w-64 h-64 bg-beige-200/30 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-20 right-20 w-80 h-80 bg-beige-300/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative mb-8 text-center">
                <a href="/">
                    <h1 class="font-display text-4xl font-bold text-gradient">Hechizos</h1>
                    <p class="text-sm text-beige-500 -mt-1">Diseños y Complementos</p>
                </a>
            </div>

            <div class="relative w-full sm:max-w-md mt-2 px-8 py-8 bg-white shadow-premium-lg rounded-3xl border border-beige-200/60 animate-fade-in">
                {{ $slot }}
            </div>

            <p class="relative mt-6 text-xs text-beige-400">&copy; {{ date('Y') }} Hechizos Diseños y Complementos</p>
        </div>
    </body>
</html>

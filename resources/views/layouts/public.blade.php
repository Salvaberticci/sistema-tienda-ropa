<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Hechizos Diseños y Complementos') }} @isset($title) — {{ $title }} @endisset</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-beige-800 bg-white antialiased min-h-screen flex flex-col">
    <nav class="bg-white/90 backdrop-blur-md border-b border-beige-200/60 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="flex items-center gap-2">
                    <span class="font-display text-2xl font-bold text-gradient">Hechizos</span>
                </a>
                <div class="flex items-center gap-6">
                    <a href="{{ route('catalogo.index') }}" class="nav-link {{ request()->routeIs('catalogo.*') ? 'nav-link-active' : '' }}">
                        Productos
                    </a>
                    <a href="{{ route('carrito.index') }}" class="relative p-2 text-beige-500 hover:text-beige-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        @php $cartCount = count(session('carrito', [])); @endphp
                        @if ($cartCount > 0)
                            <span class="absolute -top-0.5 -right-0.5 w-5 h-5 bg-beige-600 text-white text-[10px] font-bold rounded-full flex items-center justify-center shadow-soft">{{ $cartCount }}</span>
                        @endif
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary btn-sm">
                            Panel
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-outline btn-sm">
                            Iniciar sesión
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary btn-sm">
                            Registrarse
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-1">
        {{ $slot }}
    </main>

    <footer class="bg-gradient-to-br from-beige-800 to-beige-900 text-beige-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="font-display text-2xl font-bold text-white mb-2">Hechizos</p>
                <p class="text-beige-400 text-sm mb-1">Diseños y Complementos</p>
                <p class="text-beige-500 text-xs">&copy; {{ date('Y') }} Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</body>
</html>

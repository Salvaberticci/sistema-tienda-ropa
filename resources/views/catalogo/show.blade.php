<x-public-layout>
    <div class="bg-white border-b border-beige-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ route('catalogo.index') }}" class="text-beige-500 hover:text-beige-700 transition-colors">Productos</a>
                <svg class="w-4 h-4 text-beige-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-beige-800 font-medium">{{ $producto->nombre }}</span>
            </nav>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 lg:gap-16 items-start">
                <div class="aspect-square rounded-3xl bg-gradient-to-br from-beige-100 via-beige-50 to-white overflow-hidden shadow-premium-lg">
                    @if ($producto->imagen_url)
                        <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-beige-300">
                            <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    @endif
                </div>

                <div class="animate-fade-in">
                    <span class="inline-flex px-3 py-1.5 bg-beige-100 rounded-xl text-xs font-semibold text-beige-600 uppercase tracking-wider">{{ $producto->categoria?->nombre }}</span>
                    <h1 class="font-display text-4xl lg:text-5xl font-bold text-beige-800 mt-4 leading-tight">{{ $producto->nombre }}</h1>

                    <div class="mt-8 flex items-baseline gap-2">
                        <span class="text-4xl font-bold text-beige-800">${{ number_format($producto->precio, 2) }}</span>
                    </div>

                    @if ($producto->descripcion)
                        <div class="mt-6">
                            <p class="text-beige-600 leading-relaxed text-lg">{{ $producto->descripcion }}</p>
                        </div>
                    @endif

                    <div class="mt-8 p-6 bg-beige-50 rounded-2xl border border-beige-200/60">
                        <div class="flex items-center justify-between mb-4">
                            <span class="font-medium text-beige-700">Disponibilidad</span>
                            @if ($producto->stock > 0)
                                <span class="badge-success">{{ $producto->stock }} en stock</span>
                            @else
                                <span class="badge-danger">Agotado</span>
                            @endif
                        </div>

                        <div class="flex items-center gap-4">
                            @auth
                                <form method="POST" action="{{ route('carrito.store') }}" class="flex items-center gap-3 flex-1">
                                    @csrf
                                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                    <div class="flex items-center rounded-xl border border-beige-200 bg-white overflow-hidden">
                                        <button type="button" onclick="this.parentNode.querySelector('input').stepDown(); this.parentNode.querySelector('input').dispatchEvent(new Event('change'))"
                                                class="px-3 py-2.5 text-beige-500 hover:text-beige-700 hover:bg-beige-50 transition-colors" {{ $producto->stock < 1 ? 'disabled' : '' }}>−</button>
                                        <input type="number" name="cantidad" value="1" min="1" max="{{ $producto->stock }}"
                                               class="w-14 text-center border-0 bg-transparent text-sm font-medium text-beige-800 focus:ring-0" {{ $producto->stock < 1 ? 'disabled' : '' }}>
                                        <button type="button" onclick="this.parentNode.querySelector('input').stepUp(); this.parentNode.querySelector('input').dispatchEvent(new Event('change'))"
                                                class="px-3 py-2.5 text-beige-500 hover:text-beige-700 hover:bg-beige-50 transition-colors" {{ $producto->stock < 1 ? 'disabled' : '' }}>+</button>
                                    </div>
                                    <button type="submit" class="btn-primary flex-1 justify-center" {{ $producto->stock < 1 ? 'disabled' : '' }}>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                                        </svg>
                                        Agregar al carrito
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn-primary flex-1 justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                    </svg>
                                    Inicia sesión para comprar
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            @if ($relacionados->isNotEmpty())
                <div class="mt-24">
                    <div class="flex items-end justify-between mb-10">
                        <div>
                            <h2 class="font-display text-3xl font-bold text-beige-800">Productos relacionados</h2>
                            <p class="text-beige-500 mt-1.5">Descubre más productos de la misma categoría</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach ($relacionados as $relacionado)
                            <a href="{{ route('catalogo.show', $relacionado) }}" class="product-card group">
                                <div class="product-card-image">
                                    @if ($relacionado->imagen_url)
                                        <img src="{{ $relacionado->imagen_url }}" alt="{{ $relacionado->nombre }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-beige-300">
                                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="product-card-body !p-4">
                                    <h3 class="font-display font-semibold text-beige-800 text-sm group-hover:text-beige-600 transition-colors">{{ $relacionado->nombre }}</h3>
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-beige-700 font-bold text-sm">${{ number_format($relacionado->precio, 2) }}</span>
                                        <span class="text-beige-400 group-hover:text-beige-600 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-public-layout>

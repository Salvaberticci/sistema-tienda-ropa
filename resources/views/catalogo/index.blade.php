<x-public-layout>
    <section class="bg-gradient-to-br from-beige-100 via-beige-50 to-white border-b border-beige-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="font-display text-5xl lg:text-6xl font-bold text-beige-800">Nuestros Productos</h1>
                <p class="mt-3 text-lg text-beige-600">Explora nuestra colección exclusiva de artesanías y complementos.</p>
            </div>
        </div>
    </section>

    @if ($masVendidos->isNotEmpty())
        <section class="py-10 bg-white border-b border-beige-200/60">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <svg class="w-5 h-5 text-beige-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                            <span class="text-sm font-medium text-beige-500 uppercase tracking-wider">Producto estrella de la semana</span>
                        </div>
                        <h2 class="font-display text-2xl font-bold text-beige-800">Más populares</h2>
                    </div>
                    <span class="text-sm text-beige-400">Basado en ventas de los últimos 7 días</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach ($masVendidos as $producto)
                        <a href="{{ route('catalogo.show', $producto) }}" class="product-card group relative">
                            <div class="absolute -top-2 -right-2 w-7 h-7 bg-beige-600 rounded-full flex items-center justify-center shadow-lg z-10">
                                <span class="text-white text-[10px] font-bold">{{ $loop->iteration }}</span>
                            </div>
                            <div class="product-card-image">
                                @if ($producto->imagen_url)
                                    <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-beige-300">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="product-card-body">
                                <span class="text-[10px] font-semibold text-beige-400 uppercase tracking-[0.2em]">{{ $producto->categoria?->nombre }}</span>
                                <h3 class="font-display text-sm font-semibold text-beige-800 mt-1.5 group-hover:text-beige-600 transition-colors">{{ $producto->nombre }}</h3>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-base font-bold text-beige-800">${{ number_format($producto->precio, 2) }}</span>
                                    <span class="text-beige-400 group-hover:text-beige-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between mb-10">
                <div class="flex gap-2 flex-wrap">
                    <a href="{{ route('catalogo.index') }}"
                       class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 {{ !request('categoria') ? 'bg-beige-600 text-white shadow-soft' : 'bg-beige-100 text-beige-600 hover:bg-beige-200' }}">
                        Todas
                    </a>
                    @foreach ($categorias as $categoria)
                        <a href="{{ route('catalogo.index', ['categoria' => $categoria->id]) }}"
                           class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 {{ request('categoria') == $categoria->id ? 'bg-beige-600 text-white shadow-soft' : 'bg-beige-100 text-beige-600 hover:bg-beige-200' }}">
                            {{ $categoria->nombre }}
                        </a>
                    @endforeach
                </div>

                <form method="GET" action="{{ route('catalogo.index') }}" class="flex gap-2">
                    @if (request('categoria'))
                        <input type="hidden" name="categoria" value="{{ request('categoria') }}">
                    @endif
                    <input type="text" name="busqueda" value="{{ request('busqueda') }}" placeholder="Buscar productos..."
                           class="input-field w-56">
                    <button type="submit" class="btn-primary btn-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Buscar
                    </button>
                </form>
            </div>

            @if ($productos->isEmpty())
                <div class="text-center py-20">
                    <svg class="w-16 h-16 text-beige-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <p class="text-beige-500 text-lg mb-4">No encontramos productos con esos criterios.</p>
                    <a href="{{ route('catalogo.index') }}" class="btn-primary">Ver todos</a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($productos as $producto)
                        <a href="{{ route('catalogo.show', $producto) }}" class="product-card group">
                            <div class="product-card-image">
                                @if ($producto->imagen_url)
                                    <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-beige-300">
                                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="product-card-body">
                                <span class="text-[10px] font-semibold text-beige-400 uppercase tracking-[0.2em]">{{ $producto->categoria?->nombre }}</span>
                                <h3 class="font-display text-lg font-semibold text-beige-800 mt-1.5 group-hover:text-beige-600 transition-colors">{{ $producto->nombre }}</h3>
                                <div class="flex items-center justify-between mt-3">
                                    <span class="text-lg font-bold text-beige-800">${{ number_format($producto->precio, 2) }}</span>
                                    <span class="text-beige-400 group-hover:text-beige-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $productos->links() }}
                </div>
            @endif
        </div>
    </div>
</x-public-layout>

<x-public-layout>
    <section class="bg-gradient-to-br from-beige-100 via-beige-50 to-white border-b border-beige-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="font-display text-5xl lg:text-6xl font-bold text-beige-800">Nuestros Productos</h1>
                <p class="mt-3 text-lg text-beige-600">Explora nuestra colección exclusiva de artesanías y complementos.</p>
            </div>
        </div>
    </section>

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

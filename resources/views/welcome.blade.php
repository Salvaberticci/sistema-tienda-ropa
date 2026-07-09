<x-public-layout>
    <section class="relative min-h-[85vh] flex items-center bg-gradient-to-br from-beige-100 via-beige-50 to-white overflow-hidden">
        <div class="absolute inset-0 bg-grid-pattern"></div>
        <div class="absolute inset-0 bg-radial-glow"></div>
        <div class="absolute top-20 left-10 w-72 h-72 bg-beige-200/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-beige-300/20 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
            <div class="text-center max-w-4xl mx-auto animate-fade-in-up">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-beige-100 rounded-full text-sm font-medium text-beige-600 mb-6">
                    <span class="w-2 h-2 bg-beige-500 rounded-full animate-pulse"></span>
                    Nueva colección 2026
                </span>
                <h1 class="font-display text-6xl lg:text-7xl xl:text-8xl font-bold text-beige-800 leading-[0.9] tracking-tight">
                    Hechizos
                    <span class="text-beige-600 block text-4xl lg:text-5xl xl:text-6xl font-normal mt-4">Diseños y Complementos</span>
                </h1>
                <p class="mt-8 text-lg lg:text-xl text-beige-600 leading-relaxed max-w-2xl mx-auto">
                    Descubre nuestra colección exclusiva de artesanías andinas y artículos importados.
                    Piezas únicas que fusionan la tradición con la modernidad.
                </p>
                <div class="mt-12 flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('catalogo.index') }}" class="btn-primary btn-lg shadow-premium-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Explorar productos
                    </a>
                    <a href="{{ route('register') }}" class="btn-outline btn-lg">
                        Crear cuenta gratis
                    </a>
                </div>
            </div>
        </div>
    </section>

    @if ($destacados->isNotEmpty())
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-end justify-between mb-12">
                    <div>
                        <h2 class="section-title">Productos destacados</h2>
                        <p class="section-subtitle">Lo más popular de nuestra colección</p>
                    </div>
                    <a href="{{ route('catalogo.index') }}" class="hidden sm:inline-flex btn-outline btn-sm">
                        Ver todos
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($destacados as $producto)
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
                <div class="mt-8 text-center sm:hidden">
                    <a href="{{ route('catalogo.index') }}" class="btn-outline">Ver todos los productos</a>
                </div>
            </div>
        </section>
    @endif

    <section class="py-20 bg-beige-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="section-title">Lo que ofrecemos</h2>
                <p class="section-subtitle mx-auto">Calidad y tradición en cada pieza</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="card-hover p-10 text-center group">
                    <div class="w-16 h-16 bg-gradient-to-br from-beige-100 to-beige-200 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-beige-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h3 class="font-display text-xl font-semibold text-beige-800 mb-3">Artesanías</h3>
                    <p class="text-beige-500 leading-relaxed">Productos artesanales hechos a mano con tradición venezolana.</p>
                </div>
                <div class="card-hover p-10 text-center group">
                    <div class="w-16 h-16 bg-gradient-to-br from-beige-100 to-beige-200 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-beige-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                    </div>
                    <h3 class="font-display text-xl font-semibold text-beige-800 mb-3">Importados</h3>
                    <p class="text-beige-500 leading-relaxed">Artículos de alta calidad traídos del mundo para ti.</p>
                </div>
                <div class="card-hover p-10 text-center group">
                    <div class="w-16 h-16 bg-gradient-to-br from-beige-100 to-beige-200 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-beige-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-display text-xl font-semibold text-beige-800 mb-3">Entrega rápida</h3>
                    <p class="text-beige-500 leading-relaxed">Recibe tus productos en la comodidad de tu hogar.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="max-w-3xl mx-auto">
                <div class="w-16 h-16 bg-gradient-to-br from-beige-200 to-beige-300 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-beige-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h2 class="section-title mb-4">Visítanos</h2>
                <p class="text-beige-600 text-lg mb-2">Av. Independencia, Calle 3 Miranda</p>
                <p class="text-beige-600 text-lg mb-2">C.C. Plaza Marina, 2do piso, Local 30</p>
                <p class="text-beige-500">Municipio Trujillo, Estado Trujillo</p>
            </div>
        </div>
    </section>
</x-public-layout>

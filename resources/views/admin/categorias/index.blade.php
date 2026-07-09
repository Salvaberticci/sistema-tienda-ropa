<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="page-heading">Categorías</h2>
                <p class="text-sm text-beige-500 mt-0.5">Organiza tus productos por categorías</p>
            </div>
            <a href="{{ route('admin.categorias.create') }}" class="btn-primary btn-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nueva categoría
            </a>
        </div>
    </x-slot>

    <div class="content-area">
        @if (session('success'))
            <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm animate-fade-in">{{ session('success') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($categorias as $categoria)
                <div class="card-hover p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-beige-100 to-beige-200 flex items-center justify-center">
                            <svg class="w-6 h-6 text-beige-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        @if ($categoria->activo)
                            <span class="badge-success">Activa</span>
                        @else
                            <span class="badge-danger">Inactiva</span>
                        @endif
                    </div>
                    <h3 class="font-display text-lg font-semibold text-beige-800">{{ $categoria->nombre }}</h3>
                    @if ($categoria->descripcion)
                        <p class="text-sm text-beige-500 mt-1.5 line-clamp-2">{{ $categoria->descripcion }}</p>
                    @endif
                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-beige-100">
                        <span class="text-xs text-beige-400">{{ $categoria->productos_count }} productos</span>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.categorias.edit', $categoria) }}" class="text-sm font-medium text-beige-600 hover:text-beige-800 transition-colors">
                                Editar
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-beige-400">
                    No hay categorías registradas.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>

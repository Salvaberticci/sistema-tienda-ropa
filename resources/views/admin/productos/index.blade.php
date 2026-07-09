<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="page-heading">Productos</h2>
                <p class="text-sm text-beige-500 mt-0.5">Gestiona tu catálogo de productos</p>
            </div>
            <a href="{{ route('admin.productos.create') }}" class="btn-primary btn-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nuevo producto
            </a>
        </div>
    </x-slot>

    <div class="content-area">
        @if (session('success'))
            <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm animate-fade-in">{{ session('success') }}</div>
        @endif

        <div class="table-container">
            <table class="w-full">
                <thead>
                    <tr class="bg-beige-50">
                        <th class="table-header">Producto</th>
                        <th class="table-header">Categoría</th>
                        <th class="table-header text-right">Precio</th>
                        <th class="table-header text-center">Stock</th>
                        <th class="table-header text-center">Estado</th>
                        <th class="table-header text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-beige-100">
                    @forelse ($productos as $producto)
                        <tr class="table-row-hover">
                            <td class="table-cell">
                                <div class="flex items-center gap-3">
                                    @if ($producto->imagen_url)
                                        <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="w-11 h-11 rounded-xl object-cover bg-beige-100 ring-1 ring-beige-200">
                                    @else
                                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-beige-100 to-beige-200 flex items-center justify-center text-beige-400 text-xs ring-1 ring-beige-200">—</div>
                                    @endif
                                    <span class="font-medium text-beige-800">{{ $producto->nombre }}</span>
                                </div>
                            </td>
                            <td class="table-cell text-beige-500">{{ $producto->categoria?->nombre ?? '—' }}</td>
                            <td class="table-cell text-right font-medium text-beige-800">${{ number_format($producto->precio, 2) }}</td>
                            <td class="table-cell text-center">
                                @if ($producto->stock <= $producto->stock_minimo)
                                    <span class="badge-danger">{{ $producto->stock }}</span>
                                @else
                                    <span class="badge-neutral">{{ $producto->stock }}</span>
                                @endif
                            </td>
                            <td class="table-cell text-center">
                                @if ($producto->activo)
                                    <span class="badge-success">Activo</span>
                                @else
                                    <span class="badge-danger">Inactivo</span>
                                @endif
                            </td>
                            <td class="table-cell text-right">
                                <a href="{{ route('admin.productos.edit', $producto) }}" class="btn-secondary btn-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="table-cell text-center text-beige-400 py-12">No hay productos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $productos->links() }}
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="page-heading">Inventario</h2>
                <p class="text-sm text-beige-500 mt-0.5">Historial de movimientos de inventario</p>
            </div>
            <a href="{{ route('admin.inventario.create') }}" class="btn-primary btn-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nuevo movimiento
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
                        <th class="table-header">Fecha</th>
                        <th class="table-header">Producto</th>
                        <th class="table-header text-center">Tipo</th>
                        <th class="table-header text-center">Cantidad</th>
                        <th class="table-header">Motivo</th>
                        <th class="table-header text-right">Registró</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-beige-100">
                    @forelse ($movimientos as $movimiento)
                        <tr class="table-row-hover">
                            <td class="table-cell text-beige-500">{{ $movimiento->created_at->format('d/m/Y h:i A') }}</td>
                            <td class="table-cell font-medium text-beige-800">{{ $movimiento->producto->nombre }}</td>
                            <td class="table-cell text-center">
                                @if ($movimiento->tipo === 'entrada')
                                    <span class="badge-success">Entrada</span>
                                @else
                                    <span class="badge-danger">Salida</span>
                                @endif
                            </td>
                            <td class="table-cell text-center font-semibold">{{ $movimiento->cantidad }}</td>
                            <td class="table-cell text-beige-500 max-w-[200px] truncate">{{ $movimiento->motivo }}</td>
                            <td class="table-cell text-right text-beige-500">{{ $movimiento->usuario->name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="table-cell text-center text-beige-400 py-12">No hay movimientos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $movimientos->links() }}</div>
    </div>
</x-app-layout>

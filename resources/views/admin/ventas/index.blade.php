<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="page-heading">Ventas</h2>
                <p class="text-sm text-beige-500 mt-0.5">Gestiona los pedidos y ventas del sistema</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.ventas.reporte-mensual') }}" class="btn-secondary btn-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Reporte mensual
                </a>
                <a href="{{ route('admin.ventas.create') }}" class="btn-primary btn-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nueva venta
                </a>
            </div>
        </div>
    </x-slot>

    <div class="content-area" x-data="{ abrirModal: null, estadoDestino: null, ventaId: null }">
        @if (session('success'))
            <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm animate-fade-in">{{ session('success') }}</div>
        @endif

        <div class="table-container">
            <table class="w-full">
                <thead>
                    <tr class="bg-beige-50">
                        <th class="table-header">#</th>
                        <th class="table-header">Cliente</th>
                        <th class="table-header">Fecha</th>
                        <th class="table-header text-right">Total</th>
                        <th class="table-header text-center">Estado</th>
                        <th class="table-header text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-beige-100">
                    @forelse ($ventas as $venta)
                        <tr class="table-row-hover">
                            <td class="table-cell font-medium text-beige-800">#{{ $venta->id }}</td>
                            <td class="table-cell">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-beige-300 to-beige-400 text-white text-xs font-bold flex items-center justify-center">
                                        {{ substr($venta->user->name, 0, 2) }}
                                    </span>
                                    <span class="text-beige-800">{{ $venta->user->name }}</span>
                                </div>
                            </td>
                            <td class="table-cell text-beige-500">{{ $venta->created_at->format('d/m/Y h:i A') }}</td>
                            <td class="table-cell text-right font-semibold text-beige-800">${{ number_format($venta->total, 2) }}</td>
                            <td class="table-cell text-center">
                                @php
                                    $badgeMap = ['pendiente' => 'badge-warning', 'confirmado' => 'badge-info', 'enviado' => 'badge-purple', 'entregado' => 'badge-success', 'cancelado' => 'badge-danger'];
                                @endphp
                                <span class="{{ $badgeMap[$venta->estado] ?? 'badge-neutral' }}">
                                    {{ ucfirst($venta->estado) }}
                                </span>
                            </td>
                            <td class="table-cell text-right">
                                <div class="flex items-center justify-end gap-1">
                                    @if ($venta->estado === 'pendiente')
                                        <button @click="abrirModal='{{ $venta->id }}'; estadoDestino='confirmado'; ventaId='{{ $venta->id }}'" class="btn-success btn-xs">Confirmar</button>
                                        <button @click="abrirModal='{{ $venta->id }}'; estadoDestino='cancelado'; ventaId='{{ $venta->id }}'" class="btn-danger btn-xs">Cancelar</button>
                                    @elseif ($venta->estado === 'confirmado')
                                        <button @click="abrirModal='{{ $venta->id }}'; estadoDestino='enviado'; ventaId='{{ $venta->id }}'" class="btn-purple btn-xs">Enviar</button>
                                        <button @click="abrirModal='{{ $venta->id }}'; estadoDestino='cancelado'; ventaId='{{ $venta->id }}'" class="btn-danger btn-xs">Cancelar</button>
                                    @elseif ($venta->estado === 'enviado')
                                        <button @click="abrirModal='{{ $venta->id }}'; estadoDestino='entregado'; ventaId='{{ $venta->id }}'" class="btn-success btn-xs">Entregar</button>
                                        <button @click="abrirModal='{{ $venta->id }}'; estadoDestino='cancelado'; ventaId='{{ $venta->id }}'" class="btn-danger btn-xs">Cancelar</button>
                                    @elseif ($venta->estado === 'entregado')
                                        <span class="text-xs text-beige-400 italic">Completado</span>
                                    @else
                                        <span class="text-xs text-beige-400 italic">Anulada</span>
                                    @endif
                                    <a href="{{ route('admin.ventas.show', $venta) }}" class="btn-secondary btn-xs ml-1">Detalle</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="table-cell text-center text-beige-400 py-12">No hay ventas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $ventas->links() }}</div>

        {{-- Modal de confirmación --}}
        <div x-show="abrirModal !== null" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;" @keydown.escape.window="abrirModal = null">
            <div class="fixed inset-0 bg-black/40" @click="abrirModal = null"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl p-6 max-w-sm w-full animate-fade-in">
                <h3 class="font-display text-lg font-semibold text-beige-800 mb-2">Cambiar estado</h3>
                <p class="text-beige-600 text-sm mb-6">
                    ¿Estás seguro de cambiar esta venta a
                    <strong class="text-beige-800" x-text="estadoDestino"></strong>?
                </p>
                <div class="flex justify-end gap-3">
                    <button @click="abrirModal = null" class="btn-secondary text-sm">Cancelar</button>
                    <form method="POST" :action="`{{ url('admin/ventas') }}/${ventaId}`">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="estado" :value="estadoDestino">
                        <button type="submit" class="btn-primary text-sm">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

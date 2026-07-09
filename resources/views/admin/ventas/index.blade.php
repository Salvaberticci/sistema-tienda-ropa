<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="page-heading">Ventas</h2>
                <p class="text-sm text-beige-500 mt-0.5">Gestiona los pedidos y ventas del sistema</p>
            </div>
            <a href="{{ route('admin.ventas.create') }}" class="btn-primary btn-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nueva venta
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
                        <th class="table-header">#</th>
                        <th class="table-header">Cliente</th>
                        <th class="table-header">Fecha</th>
                        <th class="table-header text-right">Total</th>
                        <th class="table-header text-center">Estado</th>
                        <th class="table-header text-right"></th>
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
                                <a href="{{ route('admin.ventas.show', $venta) }}" class="btn-secondary btn-sm">Gestionar</a>
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
    </div>
</x-app-layout>

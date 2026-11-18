<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-xl font-bold text-beige-800 leading-tight">Mis pedidos</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($ventas->isEmpty())
                <div class="text-center py-16">
                    <p class="text-beige-500 text-lg mb-4">No has realizado ningún pedido aún.</p>
                    <a href="{{ route('catalogo.index') }}" class="btn-primary">Ver productos</a>
                </div>
            @else
                @php
                    $estadoClases = [
                        'pendiente' => 'bg-yellow-100 text-yellow-700',
                        'confirmado' => 'bg-blue-100 text-blue-700',
                        'enviado' => 'bg-purple-100 text-purple-700',
                        'entregado' => 'bg-green-100 text-green-700',
                        'cancelado' => 'bg-red-100 text-red-700',
                    ];
                @endphp

                <div class="card overflow-hidden">
                    {{-- Tabla para pantallas medianas y grandes --}}
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full min-w-[640px] text-sm">
                            <thead>
                                <tr class="border-b border-beige-200 bg-beige-50">
                                    <th class="text-left px-6 py-3 font-medium text-beige-600">Pedido</th>
                                    <th class="text-left px-6 py-3 font-medium text-beige-600">Fecha</th>
                                    <th class="text-right px-6 py-3 font-medium text-beige-600">Total</th>
                                    <th class="text-center px-6 py-3 font-medium text-beige-600">Estado</th>
                                    <th class="text-right px-6 py-3 font-medium text-beige-600"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ventas as $venta)
                                    <tr class="border-b border-beige-100 last:border-0">
                                        <td class="px-6 py-4 font-medium text-beige-800">#{{ $venta->id }}</td>
                                        <td class="px-6 py-4 text-beige-600">{{ $venta->created_at->format('d/m/Y h:i A') }}</td>
                                        <td class="px-6 py-4 text-right font-medium text-beige-800">${{ number_format($venta->total, 2) }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium {{ $estadoClases[$venta->estado] ?? 'bg-beige-100 text-beige-700' }}">
                                                {{ ucfirst($venta->estado) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('pedidos.show', $venta) }}" class="text-beige-600 hover:text-beige-800 font-medium text-sm">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Tarjetas apiladas para celulares --}}
                    <div class="divide-y divide-beige-100 md:hidden">
                        @foreach ($ventas as $venta)
                            <div class="p-4">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <p class="font-medium text-beige-800">Pedido #{{ $venta->id }}</p>
                                        <p class="text-sm text-beige-600">{{ $venta->created_at->format('d/m/Y') }}</p>
                                        <p class="text-xs text-beige-500">{{ $venta->created_at->format('h:i A') }}</p>
                                    </div>
                                    <span class="inline-flex shrink-0 px-2.5 py-1 rounded-full text-[11px] font-medium {{ $estadoClases[$venta->estado] ?? 'bg-beige-100 text-beige-700' }}">
                                        {{ ucfirst($venta->estado) }}
                                    </span>
                                </div>

                                <div class="mt-3 flex items-end justify-between gap-3 border-t border-beige-100 pt-3">
                                    <div>
                                        <p class="text-[11px] uppercase tracking-wide text-beige-500">Total</p>
                                        <p class="font-semibold text-beige-800">${{ number_format($venta->total, 2) }}</p>
                                    </div>
                                    <a href="{{ route('pedidos.show', $venta) }}" class="inline-flex items-center gap-1 py-1 text-sm font-medium text-beige-700 hover:text-beige-900">
                                        Ver detalle
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4">{{ $ventas->links() }}</div>
            @endif
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-xl font-bold text-beige-800 leading-tight">Mis pedidos</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if ($ventas->isEmpty())
                <div class="text-center py-16">
                    <p class="text-beige-500 text-lg mb-4">No has realizado ningún pedido aún.</p>
                    <a href="{{ route('catalogo.index') }}" class="btn-primary">Ver productos</a>
                </div>
            @else
                <div class="card">
                    <table class="w-full text-sm">
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
                                <tr class="border-b border-beige-100">
                                    <td class="px-6 py-4 font-medium text-beige-800">#{{ $venta->id }}</td>
                                    <td class="px-6 py-4 text-beige-600">{{ $venta->created_at->format('d/m/Y h:i A') }}</td>
                                    <td class="px-6 py-4 text-right font-medium text-beige-800">${{ number_format($venta->total, 2) }}</td>
                                    <td class="px-6 py-4 text-center">
                                        @php
                                            $colors = ['pendiente' => 'bg-yellow-100 text-yellow-700', 'confirmado' => 'bg-blue-100 text-blue-700', 'enviado' => 'bg-purple-100 text-purple-700', 'entregado' => 'bg-green-100 text-green-700', 'cancelado' => 'bg-red-100 text-red-700'];
                                            $label = $venta->estado;
                                        @endphp
                                        <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium {{ $colors[$venta->estado] ?? 'bg-beige-100 text-beige-700' }}">
                                            {{ ucfirst($label) }}
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
                <div class="mt-4">{{ $ventas->links() }}</div>
            @endif
        </div>
    </div>
</x-app-layout>

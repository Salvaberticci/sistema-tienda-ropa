<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-display text-xl font-bold text-beige-800 leading-tight">Pedido #{{ $venta->id }}</h2>
            <a href="{{ route('pedidos.index') }}" class="btn-secondary text-sm">Volver</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @php
                $colors = ['pendiente' => 'bg-yellow-100 text-yellow-700', 'confirmado' => 'bg-blue-100 text-blue-700', 'enviado' => 'bg-purple-100 text-purple-700', 'entregado' => 'bg-green-100 text-green-700', 'cancelado' => 'bg-red-100 text-red-700'];
            @endphp
            <div class="flex justify-end gap-2 mb-4">
                <a href="{{ route('factura.download', $venta) }}" class="btn-primary text-sm">
                    Descargar factura PDF
                </a>
            </div>
            <div class="card p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <p class="text-sm text-beige-500">Fecha: <span class="text-beige-800">{{ $venta->created_at->format('d/m/Y h:i A') }}</span></p>
                    </div>
                    <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium {{ $colors[$venta->estado] ?? 'bg-beige-100 text-beige-700' }}">
                        {{ ucfirst($venta->estado) }}
                    </span>
                </div>

                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-beige-200">
                            <th class="text-left py-2 font-medium text-beige-600">Producto</th>
                            <th class="text-center py-2 font-medium text-beige-600">Cant</th>
                            <th class="text-right py-2 font-medium text-beige-600">Precio</th>
                            <th class="text-right py-2 font-medium text-beige-600">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($venta->productos as $item)
                            <tr class="border-b border-beige-100">
                                <td class="py-3 text-beige-800">{{ $item->producto->nombre }}</td>
                                <td class="py-3 text-center text-beige-600">{{ $item->cantidad }}</td>
                                <td class="py-3 text-right text-beige-600">${{ number_format($item->precio_unitario, 2) }}</td>
                                <td class="py-3 text-right font-medium text-beige-800">${{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="py-3 text-right font-medium text-beige-800 text-base">Total</td>
                            <td class="py-3 text-right font-bold text-beige-800 text-lg">${{ number_format($venta->total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

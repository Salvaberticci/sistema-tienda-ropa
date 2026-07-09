<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-display text-xl font-bold text-beige-800 leading-tight">Venta #{{ $venta->id }}</h2>
            <a href="{{ route('admin.ventas.index') }}" class="btn-secondary text-sm">Volver</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end gap-2 mb-4">
                <a href="{{ route('factura.download', $venta) }}" class="btn-primary text-sm">
                    Descargar factura PDF
                </a>
            </div>
            <div class="card p-6 mb-6">
                <div class="grid grid-cols-2 gap-4 text-sm mb-6">
                    <div>
                        <p class="text-beige-500">Cliente</p>
                        <p class="font-medium text-beige-800">{{ $venta->user->name }}</p>
                        <p class="text-beige-600">{{ $venta->user->email }}</p>
                        <p class="text-beige-600">{{ $venta->user->telefono ?: '' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-beige-500">Fecha</p>
                        <p class="font-medium text-beige-800">{{ $venta->created_at->format('d/m/Y h:i A') }}</p>
                        <form method="POST" action="{{ route('admin.ventas.update', $venta) }}" class="mt-3 flex items-center justify-end gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="estado" class="rounded-lg border-beige-300 text-sm focus:border-beige-500 focus:ring-beige-500">
                                @foreach (['pendiente', 'confirmado', 'enviado', 'entregado', 'cancelado'] as $estado)
                                    <option value="{{ $estado }}" {{ $venta->estado === $estado ? 'selected' : '' }}>{{ ucfirst($estado) }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn-primary text-sm">Actualizar</button>
                        </form>
                    </div>
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

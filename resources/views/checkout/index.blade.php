<x-public-layout>
    <section class="bg-gradient-to-br from-beige-100 via-beige-50 to-white border-b border-beige-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h1 class="font-display text-5xl lg:text-6xl font-bold text-beige-800">Confirmar pedido</h1>
            <p class="mt-3 text-lg text-beige-600">Revisa los detalles antes de finalizar</p>
        </div>
    </section>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="mb-6 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm animate-fade-in">{{ session('error') }}</div>
            @endif

            <div class="card p-6 mb-6">
                <h3 class="font-display text-xl font-semibold text-beige-800 mb-6">Resumen del pedido</h3>
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-beige-200">
                            <th class="text-left py-3 font-medium text-beige-500">Producto</th>
                            <th class="text-center py-3 font-medium text-beige-500">Cant</th>
                            <th class="text-right py-3 font-medium text-beige-500">Precio</th>
                            <th class="text-right py-3 font-medium text-beige-500">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carrito as $id => $cantidad)
                            @php $p = $productos[$id] ?? null; @endphp
                            @if ($p)
                                <tr class="border-b border-beige-100">
                                    <td class="py-3.5 text-beige-800">{{ $p->nombre }}</td>
                                    <td class="py-3.5 text-center text-beige-500">{{ $cantidad }}</td>
                                    <td class="py-3.5 text-right text-beige-500">${{ number_format($p->precio, 2) }}</td>
                                    <td class="py-3.5 text-right font-medium text-beige-800">${{ number_format($p->precio * $cantidad, 2) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="py-4 text-right font-semibold text-beige-700 text-base">Total</td>
                            <td class="py-4 text-right font-bold text-beige-800 text-2xl">${{ number_format($total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="card p-6 mb-6">
                <h3 class="font-display text-xl font-semibold text-beige-800 mb-4">Datos de envío</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="p-4 bg-beige-50 rounded-xl">
                        <p class="text-beige-400 text-xs font-medium uppercase tracking-wider mb-1">Nombre</p>
                        <p class="text-beige-800 font-medium">{{ auth()->user()->name }}</p>
                    </div>
                    <div class="p-4 bg-beige-50 rounded-xl">
                        <p class="text-beige-400 text-xs font-medium uppercase tracking-wider mb-1">Email</p>
                        <p class="text-beige-800 font-medium">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="p-4 bg-beige-50 rounded-xl">
                        <p class="text-beige-400 text-xs font-medium uppercase tracking-wider mb-1">Teléfono</p>
                        <p class="text-beige-800 font-medium">{{ auth()->user()->telefono ?: '—' }}</p>
                    </div>
                    <div class="p-4 bg-beige-50 rounded-xl">
                        <p class="text-beige-400 text-xs font-medium uppercase tracking-wider mb-1">Dirección</p>
                        <p class="text-beige-800 font-medium">{{ auth()->user()->direccion ?: '—' }}</p>
                    </div>
                </div>
                <p class="text-beige-400 text-xs mt-3 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Puedes actualizar tus datos desde tu perfil.
                </p>
            </div>

            <form method="POST" action="{{ route('checkout.store') }}" class="flex flex-col sm:flex-row justify-end gap-3">
                @csrf
                <a href="{{ route('carrito.index') }}" class="btn-outline order-2 sm:order-1">Volver al carrito</a>
                <button type="submit" class="btn-primary btn-lg order-1 sm:order-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Confirmar pedido
                </button>
            </form>
        </div>
    </div>
</x-public-layout>

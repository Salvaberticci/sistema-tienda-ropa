<x-public-layout>
    <section class="bg-gradient-to-br from-beige-100 via-beige-50 to-white border-b border-beige-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h1 class="font-display text-5xl lg:text-6xl font-bold text-beige-800">Carrito de compras</h1>
            <p class="mt-3 text-lg text-beige-600">Revisa los productos antes de comprar</p>
        </div>
    </section>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm animate-fade-in">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="mb-6 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm animate-fade-in">{{ session('error') }}</div>
            @endif

            @if (empty($carrito))
                <div class="text-center py-20">
                    <svg class="w-24 h-24 text-beige-200 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                    </svg>
                    <p class="text-beige-500 text-xl mb-6">Tu carrito está vacío</p>
                    <a href="{{ route('catalogo.index') }}" class="btn-primary btn-lg">Explorar productos</a>
                </div>
            @else
                <div class="card overflow-hidden">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-beige-50 border-b border-beige-200/60">
                                <th class="table-header">Producto</th>
                                <th class="table-header text-center">Cantidad</th>
                                <th class="table-header text-right">Precio</th>
                                <th class="table-header text-right">Subtotal</th>
                                <th class="table-header text-right w-20"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-beige-100">
                            @foreach ($carrito as $id => $cantidad)
                                @php $producto = $productos[$id] ?? null; @endphp
                                @if ($producto)
                                    <tr class="table-row-hover">
                                        <td class="table-cell">
                                            <div class="flex items-center gap-3">
                                                @if ($producto->imagen_url)
                                                    <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="w-14 h-14 rounded-xl object-cover bg-beige-100 ring-1 ring-beige-200">
                                                @else
                                                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-beige-100 to-beige-200 flex items-center justify-center text-beige-300 ring-1 ring-beige-200">—</div>
                                                @endif
                                                <span class="font-medium text-beige-800">{{ $producto->nombre }}</span>
                                            </div>
                                        </td>
                                        <td class="table-cell text-center">
                                            <form method="POST" action="{{ route('carrito.update', $id) }}" class="flex items-center justify-center gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <input type="number" name="cantidad" value="{{ $cantidad }}" min="0" max="{{ $producto->stock }}"
                                                       class="w-16 text-center input-field !py-1.5">
                                                <button type="submit" class="text-xs text-beige-500 hover:text-beige-700 font-medium transition-colors">Actualizar</button>
                                            </form>
                                        </td>
                                        <td class="table-cell text-right text-beige-500">${{ number_format($producto->precio, 2) }}</td>
                                        <td class="table-cell text-right font-semibold text-beige-800">${{ number_format($producto->precio * $cantidad, 2) }}</td>
                                        <td class="table-cell text-right">
                                            <form method="POST" action="{{ route('carrito.destroy', $id) }}" onsubmit="return confirm('¿Eliminar este producto del carrito?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-600 transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-beige-50">
                                <td colspan="3" class="table-cell text-right font-medium text-beige-700 text-base">Total</td>
                                <td class="table-cell text-right font-bold text-beige-800 text-xl">${{ number_format($total, 2) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <a href="{{ route('catalogo.index') }}" class="btn-outline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                        </svg>
                        Seguir comprando
                    </a>
                    @auth
                        <a href="{{ route('checkout.index') }}" class="btn-primary btn-lg">
                            Proceder al pago
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary btn-lg">
                            Inicia sesión para pagar
                        </a>
                    @endauth
                </div>
            @endif
        </div>
    </div>
</x-public-layout>

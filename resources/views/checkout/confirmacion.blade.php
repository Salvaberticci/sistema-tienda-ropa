<x-public-layout>
    <div class="min-h-[60vh] flex items-center justify-center bg-gradient-to-br from-emerald-50 via-white to-beige-50">
        <div class="max-w-lg mx-auto px-4 text-center animate-fade-in-up">
            <div class="w-20 h-20 bg-gradient-to-br from-emerald-400 to-emerald-500 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-soft-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h1 class="font-display text-4xl font-bold text-beige-800 mb-3">Pedido confirmado</h1>
            <p class="text-beige-600 text-lg mb-6">Gracias por tu compra. Te notificaremos cuando el pedido sea procesado.</p>
            <div class="inline-flex items-center gap-2 px-6 py-3 bg-beige-100 rounded-2xl mb-8">
                <span class="text-sm text-beige-500">N° de pedido:</span>
                <span class="font-bold text-beige-800 text-lg">#{{ $venta->id }}</span>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('pedidos.show', $venta) }}" class="btn-primary">Ver detalle del pedido</a>
                <a href="{{ route('catalogo.index') }}" class="btn-outline">Seguir comprando</a>
            </div>
        </div>
    </div>
</x-public-layout>

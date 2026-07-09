<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-display text-xl font-bold text-beige-800 leading-tight">Nueva venta presencial</h2>
            <a href="{{ route('admin.ventas.index') }}" class="btn-secondary text-sm">Volver</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.ventas.store') }}" x-data="{
                items: [{ producto_id: '', cantidad: 1 }],
                productos: {{ json_encode($productos->map(fn($p) => ['id' => $p->id, 'nombre' => $p->nombre, 'precio' => $p->precio, 'stock' => $p->stock])) }},
                get precioTotal() {
                    return this.items.reduce((sum, item) => {
                        const p = this.productos.find(pr => pr.id == item.producto_id);
                        return sum + (p ? p.precio * (parseInt(item.cantidad) || 0) : 0);
                    }, 0);
                },
                addItem() {
                    this.items.push({ producto_id: '', cantidad: 1 });
                },
                removeItem(index) {
                    if (this.items.length > 1) this.items.splice(index, 1);
                }
            }">
                @csrf

                <div class="card p-6 mb-6">
                    <h3 class="font-display text-lg font-semibold text-beige-800 mb-4">Productos</h3>

                    <template x-for="(item, index) in items" :key="index">
                        <div class="flex items-end gap-3 mb-3">
                            <div class="flex-1">
                                <label class="block text-xs text-beige-500 mb-1">Producto</label>
                                <select x-model="item.producto_id" :name="`items[${index}][producto_id]`" required
                                        class="w-full rounded-lg border-beige-300 text-sm focus:border-beige-500 focus:ring-beige-500">
                                    <option value="">Seleccionar producto</option>
                                    @foreach ($productos as $p)
                                        <option value="{{ $p->id }}" data-precio="{{ $p->precio }}" data-stock="{{ $p->stock }}">
                                            {{ $p->nombre }} - ${{ number_format($p->precio, 2) }} ({{ $p->stock }} disp)
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-24">
                                <label class="block text-xs text-beige-500 mb-1">Cantidad</label>
                                <input type="number" x-model="item.cantidad" :name="`items[${index}][cantidad]`" min="1" required
                                       class="w-full rounded-lg border-beige-300 text-sm text-center focus:border-beige-500 focus:ring-beige-500">
                            </div>
                            <div class="w-28 text-right pb-2 text-sm font-medium text-beige-800" x-text="'$' + (() => { const p = productos.find(pr => pr.id == item.producto_id); return p ? (p.precio * (parseInt(item.cantidad) || 0)).toFixed(2) : '0.00'; })()">
                            </div>
                            <button type="button" @click="removeItem(index)" class="pb-2 text-red-400 hover:text-red-600" x-show="items.length > 1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </template>

                    <button type="button" @click="addItem" class="text-beige-600 hover:text-beige-800 text-sm font-medium mt-2">
                        + Agregar otro producto
                    </button>

                    <div class="text-right mt-4 pt-4 border-t border-beige-200">
                        <span class="text-lg font-bold text-beige-800">Total: $<span x-text="precioTotal.toFixed(2)">0.00</span></span>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.ventas.index') }}" class="btn-secondary">Cancelar</a>
                    <button type="submit" class="btn-primary text-lg px-8 py-3">Registrar venta</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="page-heading">Nuevo movimiento de inventario</h2>
                <p class="text-sm text-beige-500 mt-0.5">Registra entrada o salida de productos</p>
            </div>
            <a href="{{ route('admin.inventario.index') }}" class="btn-secondary btn-sm">Volver</a>
        </div>
    </x-slot>

    <div class="content-area max-w-2xl">
        @if ($errors->any())
            <div class="mb-6 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm animate-fade-in">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.inventario.store') }}" class="card p-8">
            @csrf

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-beige-700 mb-2">Producto</label>
                    <select name="producto_id" required class="select-field">
                        <option value="">Seleccionar producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                                {{ $producto->nombre }} (Stock: {{ $producto->stock }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-beige-700 mb-2">Tipo de movimiento</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2.5 p-4 rounded-xl border border-beige-200 cursor-pointer transition-all hover:bg-beige-50 has-[:checked]:bg-emerald-50 has-[:checked]:border-emerald-300 has-[:checked]:ring-1 has-[:checked]:ring-emerald-200">
                            <input type="radio" name="tipo" value="entrada" {{ old('tipo') !== 'salida' ? 'checked' : '' }} class="text-emerald-500 focus:ring-emerald-400">
                            <span class="text-sm font-medium text-beige-700">Entrada</span>
                        </label>
                        <label class="flex items-center gap-2.5 p-4 rounded-xl border border-beige-200 cursor-pointer transition-all hover:bg-beige-50 has-[:checked]:bg-red-50 has-[:checked]:border-red-300 has-[:checked]:ring-1 has-[:checked]:ring-red-200">
                            <input type="radio" name="tipo" value="salida" {{ old('tipo') === 'salida' ? 'checked' : '' }} class="text-red-500 focus:ring-red-400">
                            <span class="text-sm font-medium text-beige-700">Salida</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-beige-700 mb-2">Cantidad</label>
                    <input type="number" name="cantidad" value="{{ old('cantidad') }}" min="1" required class="input-field">
                </div>

                <div>
                    <label class="block text-sm font-medium text-beige-700 mb-2">Motivo</label>
                    <input type="text" name="motivo" value="{{ old('motivo') }}" placeholder="Ej: Compra a proveedor, venta, ajuste..." required class="input-field">
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-beige-200/60">
                    <a href="{{ route('admin.inventario.index') }}" class="btn-secondary">Cancelar</a>
                    <button type="submit" class="btn-primary">Registrar movimiento</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>

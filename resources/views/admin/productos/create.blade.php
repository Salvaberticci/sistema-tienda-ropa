<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-display text-xl font-bold text-beige-800 leading-tight">
                Nuevo producto
            </h2>
            <a href="{{ route('admin.productos.index') }}" class="btn-secondary text-sm">
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="card p-6">
                <form method="POST" action="{{ route('admin.productos.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <x-input-label for="nombre" :value="'Nombre'" />
                        <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required autofocus />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="categoria_id" :value="'Categoría'" />
                        <select id="categoria_id" name="categoria_id" class="border-beige-300 focus:border-beige-500 focus:ring-beige-500 rounded-md shadow-sm w-full mt-1">
                            <option value="">Sin categoría</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('categoria_id')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="descripcion" :value="'Descripción'" />
                        <textarea id="descripcion" name="descripcion" rows="3" class="border-beige-300 focus:border-beige-500 focus:ring-beige-500 rounded-md shadow-sm w-full mt-1">{{ old('descripcion') }}</textarea>
                        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>

                    <div class="mt-4 grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="precio" :value="'Precio ($)'" />
                            <x-text-input id="precio" class="block mt-1 w-full" type="number" step="0.01" min="0" name="precio" :value="old('precio')" required />
                            <x-input-error :messages="$errors->get('precio')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="stock" :value="'Stock inicial'" />
                            <x-text-input id="stock" class="block mt-1 w-full" type="number" min="0" name="stock" :value="old('stock', 0)" required />
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="stock_minimo" :value="'Stock mínimo'" />
                        <x-text-input id="stock_minimo" class="block mt-1 w-full" type="number" min="0" name="stock_minimo" :value="old('stock_minimo', 5)" required />
                        <x-input-error :messages="$errors->get('stock_minimo')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="imagen" :value="'Imagen del producto'" />
                        <input id="imagen" type="file" name="imagen" accept="image/jpg,image/jpeg,image/png,image/webp" class="block mt-1 w-full text-sm text-beige-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border file:border-beige-300 file:text-sm file:font-medium file:bg-beige-50 file:text-beige-700 hover:file:bg-beige-100" />
                        <p class="mt-1 text-xs text-beige-400">Máximo 2MB. Formatos: jpg, png, webp.</p>
                        <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex items-center gap-4">
                        <x-primary-button>Guardar</x-primary-button>
                        <a href="{{ route('admin.productos.index') }}" class="text-sm text-beige-500 hover:text-beige-700">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-display text-xl font-bold text-beige-800 leading-tight">
                Editar categoría
            </h2>
            <a href="{{ route('admin.categorias.index') }}" class="btn-secondary text-sm">
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="card p-6">
                <form method="POST" action="{{ route('admin.categorias.update', $categoria) }}">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="nombre" :value="'Nombre'" />
                        <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre', $categoria->nombre)" required autofocus />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="descripcion" :value="'Descripción'" />
                        <textarea id="descripcion" name="descripcion" rows="3" class="border-beige-300 focus:border-beige-500 focus:ring-beige-500 rounded-md shadow-sm w-full mt-1">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <label class="inline-flex items-center gap-2">
                            <input type="checkbox" name="activo" value="1" class="rounded border-beige-300 text-beige-600 focus:ring-beige-500" {{ old('activo', $categoria->activo) ? 'checked' : '' }}>
                            <span class="text-sm text-beige-700">Categoría activa</span>
                        </label>
                    </div>

                    <div class="mt-6 flex items-center gap-4">
                        <x-primary-button>Actualizar</x-primary-button>
                        <a href="{{ route('admin.categorias.index') }}" class="text-sm text-beige-500 hover:text-beige-700">Cancelar</a>
                    </div>
                </form>

                @if ($categoria->productos()->count() === 0)
                    <div class="mt-8 pt-6 border-t border-beige-200">
                        <form method="POST" action="{{ route('admin.categorias.destroy', $categoria) }}" onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium">
                                Eliminar categoría
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

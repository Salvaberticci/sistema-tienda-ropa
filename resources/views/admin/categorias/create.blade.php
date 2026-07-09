<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-display text-xl font-bold text-beige-800 leading-tight">
                Nueva categoría
            </h2>
            <a href="{{ route('admin.categorias.index') }}" class="btn-secondary text-sm">
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="card p-6">
                <form method="POST" action="{{ route('admin.categorias.store') }}">
                    @csrf

                    <div>
                        <x-input-label for="nombre" :value="'Nombre'" />
                        <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required autofocus />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="descripcion" :value="'Descripción'" />
                        <textarea id="descripcion" name="descripcion" rows="3" class="border-beige-300 focus:border-beige-500 focus:ring-beige-500 rounded-md shadow-sm w-full mt-1">{{ old('descripcion') }}</textarea>
                        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex items-center gap-4">
                        <x-primary-button>Guardar</x-primary-button>
                        <a href="{{ route('admin.categorias.index') }}" class="text-sm text-beige-500 hover:text-beige-700">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

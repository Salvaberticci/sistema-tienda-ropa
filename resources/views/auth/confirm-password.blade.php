<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="font-display text-2xl font-bold text-beige-800">Confirmar contraseña</h2>
        <p class="text-sm text-beige-500 mt-1">Esta es un área segura. Confirma tu contraseña para continuar.</p>
    </div>

    <div class="mb-4 text-sm text-beige-600">
        Esta es un área segura de la aplicación. Por favor, confirma tu contraseña antes de continuar.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <x-input-label for="password" :value="'Contraseña'" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-6">
            <x-primary-button>
                Confirmar
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

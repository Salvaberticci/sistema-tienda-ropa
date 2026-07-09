<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="font-display text-2xl font-bold text-beige-800">Crear cuenta</h2>
        <p class="text-sm text-beige-500 mt-1">Regístrate para comprar en línea</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="'Nombre completo'" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="cedula" :value="'Cédula (opcional)'" />
            <x-text-input id="cedula" class="block mt-1 w-full" type="text" name="cedula" :value="old('cedula')" placeholder="V-12345678" />
            <x-input-error :messages="$errors->get('cedula')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="telefono" :value="'Teléfono (opcional)'" />
            <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" placeholder="+58 412-1234567" />
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="'Correo electrónico'" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="'Contraseña'" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="'Confirmar contraseña'" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-beige-500 hover:text-beige-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-beige-500" href="{{ route('login') }}">
                ¿Ya tienes cuenta?
            </a>

            <x-primary-button>
                Registrarse
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

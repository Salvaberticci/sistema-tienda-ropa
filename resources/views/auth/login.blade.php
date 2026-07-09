<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-6">
        <h2 class="font-display text-2xl font-bold text-beige-800">Iniciar sesión</h2>
        <p class="text-sm text-beige-500 mt-1">Accede a tu cuenta</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="'Correo electrónico'" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="'Contraseña'" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-beige-300 text-beige-600 shadow-sm focus:ring-beige-500" name="remember">
                <span class="ms-2 text-sm text-beige-600">Recordarme</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-beige-500 hover:text-beige-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-beige-500" href="{{ route('register') }}">
                Crear cuenta
            </a>

            <x-primary-button>
                Entrar
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

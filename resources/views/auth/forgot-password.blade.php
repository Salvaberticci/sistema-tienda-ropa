<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="font-display text-2xl font-bold text-beige-800">Recuperar contraseña</h2>
        <p class="text-sm text-beige-500 mt-1">Te enviaremos un enlace para restablecer tu contraseña</p>
    </div>

    <div class="mb-4 text-sm text-beige-600">
        ¿Olvidaste tu contraseña? No hay problema. Indícanos tu correo electrónico y te enviaremos un enlace de restablecimiento.
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="'Correo electrónico'" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button>
                Enviar enlace
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

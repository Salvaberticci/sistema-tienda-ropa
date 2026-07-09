<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="font-display text-2xl font-bold text-beige-800">Verifica tu correo</h2>
        <p class="text-sm text-beige-500 mt-1">Confirma tu dirección de correo electrónico</p>
    </div>

    <div class="mb-4 text-sm text-beige-600">
        Gracias por registrarte. Antes de comenzar, verifica tu dirección de correo electrónico haciendo clic en el enlace que te enviamos. Si no recibiste el correo, te enviaremos otro.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-emerald-600 bg-emerald-50 px-4 py-3 rounded-xl">
            Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
        </div>
    @endif

    <div class="mt-6 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>
                Reenviar correo de verificación
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="underline text-sm text-beige-500 hover:text-beige-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-beige-500">
                Cerrar sesión
            </button>
        </form>
    </div>
</x-guest-layout>

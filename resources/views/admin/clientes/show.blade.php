<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-display text-xl font-bold text-beige-800 leading-tight">
                Cliente: {{ $user->name }}
            </h2>
            <a href="{{ route('admin.clientes.index') }}" class="btn-secondary text-sm">
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="card p-6">
                <h3 class="font-display text-lg font-semibold text-beige-800 mb-4">Información del cliente</h3>
                <dl class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <dt class="text-beige-500">Nombre</dt>
                        <dd class="font-medium text-beige-800">{{ $user->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-beige-500">Email</dt>
                        <dd class="font-medium text-beige-800">{{ $user->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-beige-500">Cédula</dt>
                        <dd class="font-medium text-beige-800">{{ $user->cedula ?: '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-beige-500">Teléfono</dt>
                        <dd class="font-medium text-beige-800">{{ $user->telefono ?: '—' }}</dd>
                    </div>
                    <div class="col-span-2">
                        <dt class="text-beige-500">Dirección</dt>
                        <dd class="font-medium text-beige-800">{{ $user->direccion ?: '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-beige-500">Registrado</dt>
                        <dd class="font-medium text-beige-800">{{ $user->created_at->format('d/m/Y h:i A') }}</dd>
                    </div>
                </dl>
            </div>

            <div class="card p-6 mt-6">
                <h3 class="font-display text-lg font-semibold text-beige-800 mb-4">Compras realizadas</h3>
                <p class="text-beige-500 text-sm">El historial de compras estará disponible cuando se implemente el módulo de ventas.</p>
            </div>
        </div>
    </div>
</x-app-layout>

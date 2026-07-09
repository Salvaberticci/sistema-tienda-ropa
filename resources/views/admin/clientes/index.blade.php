<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="page-heading">Clientes</h2>
                <p class="text-sm text-beige-500 mt-0.5">Usuarios registrados en el sistema</p>
            </div>
        </div>
    </x-slot>

    <div class="content-area">
        <div class="table-container">
            <table class="w-full">
                <thead>
                    <tr class="bg-beige-50">
                        <th class="table-header">Nombre</th>
                        <th class="table-header">Email</th>
                        <th class="table-header">Cédula</th>
                        <th class="table-header">Teléfono</th>
                        <th class="table-header">Registro</th>
                        <th class="table-header text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-beige-100">
                    @forelse ($clientes as $cliente)
                        <tr class="table-row-hover">
                            <td class="table-cell">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-beige-300 to-beige-500 text-white text-sm font-bold flex items-center justify-center">
                                        {{ substr($cliente->name, 0, 2) }}
                                    </span>
                                    <span class="font-medium text-beige-800">{{ $cliente->name }}</span>
                                </div>
                            </td>
                            <td class="table-cell text-beige-500">{{ $cliente->email }}</td>
                            <td class="table-cell text-beige-500">{{ $cliente->cedula ?: '—' }}</td>
                            <td class="table-cell text-beige-500">{{ $cliente->telefono ?: '—' }}</td>
                            <td class="table-cell text-beige-500">{{ $cliente->created_at->format('d/m/Y') }}</td>
                            <td class="table-cell text-right">
                                <a href="{{ route('admin.clientes.show', $cliente) }}" class="btn-secondary btn-sm">Ver detalle</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="table-cell text-center text-beige-400 py-12">No hay clientes registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $clientes->links() }}</div>
    </div>
</x-app-layout>

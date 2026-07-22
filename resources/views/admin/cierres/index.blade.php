<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="page-heading">Cierres diarios</h2>
                <p class="text-sm text-beige-500 mt-0.5">Historial de cierres de ventas del día</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn-secondary btn-sm">Dashboard</a>
        </div>
    </x-slot>

    <div class="content-area">
        @if (session('success'))
            <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm animate-fade-in">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-6 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm animate-fade-in">{{ session('error') }}</div>
        @endif

        <div class="table-container">
            <table class="w-full">
                <thead>
                    <tr class="bg-beige-50">
                        <th class="table-header">Fecha</th>
                        <th class="table-header text-right">Total ventas</th>
                        <th class="table-header text-center">Cantidad</th>
                        <th class="table-header">Cerrado por</th>
                        <th class="table-header text-right">Hora</th>
                        <th class="table-header text-right"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-beige-100">
                    @forelse ($cierres as $cierre)
                        <tr class="table-row-hover">
                            <td class="table-cell font-medium text-beige-800">{{ $cierre->fecha->isoFormat('D [de] MMMM [de] YYYY') }}</td>
                            <td class="table-cell text-right font-semibold text-beige-800">${{ number_format($cierre->total_ventas, 2) }}</td>
                            <td class="table-cell text-center text-beige-600">{{ $cierre->cantidad_ventas }}</td>
                            <td class="table-cell text-beige-600">{{ $cierre->user?->name ?? '—' }}</td>
                            <td class="table-cell text-right text-beige-500">{{ $cierre->created_at->format('h:i A') }}</td>
                            <td class="table-cell text-right">
                                <a href="{{ route('admin.cierres.download', $cierre) }}" class="btn-primary btn-xs">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    PDF
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="table-cell text-center text-beige-400 py-12">No hay cierres registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $cierres->links() }}</div>
    </div>
</x-app-layout>

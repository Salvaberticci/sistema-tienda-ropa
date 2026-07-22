<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="page-heading">Reporte mensual de ventas</h2>
                <p class="text-sm text-beige-500 mt-0.5">Selecciona el mes para descargar el PDF</p>
            </div>
            <a href="{{ route('admin.ventas.index') }}" class="btn-secondary text-sm">Volver</a>
        </div>
    </x-slot>

    <div class="content-area">
        <div class="max-w-lg mx-auto">
            <div class="card p-8">
                <form method="POST" action="{{ route('admin.ventas.reporte-mensual.download') }}">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-beige-700 mb-2">Mes</label>
                        <input type="month" name="mes" value="{{ $mes }}"
                               class="input-field" required>
                    </div>
                    <button type="submit" class="btn-primary w-full justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Descargar PDF
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

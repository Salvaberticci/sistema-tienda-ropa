<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-xl font-bold text-beige-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (auth()->user()->role === 'admin')
                @php
                    $totalProductos = \App\Models\Producto::count();
                    $totalCategorias = \App\Models\Categoria::count();
                    $totalClientes = \App\Models\User::where('role', 'cliente')->count();
                    $totalVentas = \App\Models\Venta::count();
                    $ventasHoy = \App\Models\Venta::whereDate('created_at', today())->count();
                    $ingresosHoy = \App\Models\Venta::whereDate('created_at', today())->sum('total');
                    $productosBajoStock = \App\Models\Producto::stockBajo()->count();
                    $ultimasVentas = \App\Models\Venta::with('user')->latest()->take(5)->get();
                    $hoyCierre = \App\Models\CierreDiario::where('fecha', today())->first();
                    $cierreHoy = $hoyCierre ? $hoyCierre->total_ventas : 0;
                @endphp

                <div class="mb-6 px-5 py-4 bg-gradient-to-r from-beige-100 to-beige-200/60 border border-beige-300 rounded-2xl flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-beige-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-beige-800">
                                @if ($hoyCierre)
                                    Cierre de hoy completado — ${{ number_format($hoyCierre->total_ventas, 2) }}
                                @else
                                    Cierre del día — ${{ number_format($ingresosHoy, 2) }} en {{ $ventasHoy }} venta(s)
                                @endif
                            </p>
                            <p class="text-xs text-beige-600 mt-0.5">{{ now()->isoFormat('dddd D [de] MMMM [de] YYYY') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        @if ($hoyCierre)
                            <a href="{{ route('admin.cierres.download', $hoyCierre) }}" class="btn-primary btn-xs">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Descargar PDF
                            </a>
                        @else
                            <form method="POST" action="{{ route('admin.cierres.store') }}">
                                @csrf
                                <input type="hidden" name="fecha" value="{{ now()->format('Y-m-d') }}">
                                <button type="submit" class="btn-primary btn-xs">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Cerrar día
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('admin.cierres.index') }}" class="btn-secondary btn-xs">Historial</a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div class="card p-5 flex items-center gap-4">
                        <div class="w-12 h-12 bg-beige-100 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-beige-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-beige-800">{{ $totalProductos }}</p>
                            <p class="text-xs text-beige-500">Productos</p>
                        </div>
                    </div>

                    <div class="card p-5 flex items-center gap-4">
                        <div class="w-12 h-12 bg-beige-100 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-beige-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-beige-800">{{ $totalCategorias }}</p>
                            <p class="text-xs text-beige-500">Categorías</p>
                        </div>
                    </div>

                    <div class="card p-5 flex items-center gap-4">
                        <div class="w-12 h-12 bg-beige-100 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-beige-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-beige-800">{{ $totalClientes }}</p>
                            <p class="text-xs text-beige-500">Clientes</p>
                        </div>
                    </div>

                    <div class="card p-5 flex items-center gap-4">
                        <div class="w-12 h-12 bg-beige-100 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-beige-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-beige-800">{{ $totalVentas }}</p>
                            <p class="text-xs text-beige-500">Ventas totales</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                    <div class="card p-5 flex items-center gap-4">
                        <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-green-700">${{ number_format($ingresosHoy, 2) }}</p>
                            <p class="text-xs text-beige-500">Ingresos hoy</p>
                        </div>
                    </div>

                    <div class="card p-5 flex items-center gap-4 {{ $productosBajoStock > 0 ? 'bg-red-50 border-red-200' : '' }}">
                        <div class="w-12 h-12 {{ $productosBajoStock > 0 ? 'bg-red-100' : 'bg-beige-100' }} rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 {{ $productosBajoStock > 0 ? 'text-red-600' : 'text-beige-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold {{ $productosBajoStock > 0 ? 'text-red-700' : 'text-beige-800' }}">{{ $productosBajoStock }}</p>
                            <p class="text-xs {{ $productosBajoStock > 0 ? 'text-red-600' : 'text-beige-500' }}">Productos con stock bajo</p>
                        </div>
                    </div>
                </div>

                <div class="card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-display text-lg font-semibold text-beige-800">Últimas ventas</h3>
                        <a href="{{ route('admin.ventas.index') }}" class="text-sm text-beige-600 hover:text-beige-800">Ver todas</a>
                    </div>
                    @if ($ultimasVentas->isEmpty())
                        <p class="text-beige-500 text-sm">No hay ventas registradas.</p>
                    @else
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-beige-200 text-beige-500">
                                    <th class="text-left py-2 font-medium">#</th>
                                    <th class="text-left py-2 font-medium">Cliente</th>
                                    <th class="text-right py-2 font-medium">Total</th>
                                    <th class="text-center py-2 font-medium">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ultimasVentas as $v)
                                    <tr class="border-b border-beige-100">
                                        <td class="py-2 font-medium text-beige-800">#{{ $v->id }}</td>
                                        <td class="py-2 text-beige-600">{{ $v->user->name }}</td>
                                        <td class="py-2 text-right text-beige-800 font-medium">${{ number_format($v->total, 2) }}</td>
                                        <td class="py-2 text-center">
                                            <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ ['pendiente' => 'bg-yellow-100 text-yellow-700', 'confirmado' => 'bg-blue-100 text-blue-700', 'enviado' => 'bg-purple-100 text-purple-700', 'entregado' => 'bg-green-100 text-green-700', 'cancelado' => 'bg-red-100 text-red-700'][$v->estado] ?? '' }}">
                                                {{ ucfirst($v->estado) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            @else
                <div class="card p-6 mb-6">
                    <div class="flex items-center gap-3 mb-4">
                        <svg class="w-6 h-6 text-beige-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        <div>
                            <h3 class="font-display text-lg font-semibold text-beige-800">¡Bienvenido!</h3>
                            <p class="text-sm text-beige-500">Explora nuestros productos más populares</p>
                        </div>
                    </div>
                    <a href="{{ route('catalogo.index') }}" class="btn-primary">Ver catálogo completo</a>
                </div>

                @if ($masVendidos->isNotEmpty())
                    <div class="card p-6">
                        <div class="flex items-center justify-between mb-5">
                            <div>
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-beige-500 uppercase tracking-wider">
                                    Producto estrella de la semana
                                </span>
                                <h3 class="font-display text-lg font-semibold text-beige-800 mt-0.5">Los más vendidos</h3>
                            </div>
                            <a href="{{ route('catalogo.index') }}" class="text-sm text-beige-600 hover:text-beige-800 font-medium">Ver todos</a>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach ($masVendidos as $producto)
                                <a href="{{ route('catalogo.show', $producto) }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-beige-50 transition-colors group">
                                    <div class="w-14 h-14 rounded-lg bg-beige-100 flex items-center justify-center shrink-0 overflow-hidden">
                                        @if ($producto->imagen_url)
                                            <img src="{{ $producto->imagen_url }}" alt="" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-6 h-6 text-beige-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-beige-800 truncate group-hover:text-beige-600 transition-colors">{{ $producto->nombre }}</p>
                                        <p class="text-xs text-beige-400">{{ $producto->categoria?->nombre }}</p>
                                        <p class="text-sm font-bold text-beige-800 mt-0.5">${{ number_format($producto->precio, 2) }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>

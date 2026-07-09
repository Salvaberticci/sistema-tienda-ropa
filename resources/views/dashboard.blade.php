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
                @endphp

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
                <div class="card p-6">
                    <p class="text-beige-700">¡Has iniciado sesión!</p>
                    <a href="{{ route('catalogo.index') }}" class="btn-primary mt-4 inline-block">Ver productos</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

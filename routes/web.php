<?php

use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\InventarioController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\VentaController as AdminVentaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $destacados = \App\Models\Producto::activos()->with('categoria')->inRandomOrder()->take(4)->get();
    return view('welcome', compact('destacados'));
})->name('home');

Route::get('productos', [CatalogoController::class, 'index'])->name('catalogo.index');
Route::get('productos/{producto}', [CatalogoController::class, 'show'])->name('catalogo.show');

Route::get('carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('carrito', [CarritoController::class, 'store'])->name('carrito.store');
Route::patch('carrito/{id}', [CarritoController::class, 'update'])->name('carrito.update');
Route::delete('carrito/{id}', [CarritoController::class, 'destroy'])->name('carrito.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('checkout/{venta}', [CheckoutController::class, 'confirmacion'])->name('checkout.confirmacion');

    Route::get('pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('pedidos/{venta}', [PedidoController::class, 'show'])->name('pedidos.show');

    Route::get('factura/{venta}', [FacturaController::class, 'view'])->name('factura.view');
    Route::get('factura/{venta}/download', [FacturaController::class, 'download'])->name('factura.download');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('categorias', CategoriaController::class);
    Route::resource('productos', ProductoController::class);
    Route::get('inventario', [InventarioController::class, 'index'])->name('inventario.index');
    Route::get('inventario/crear', [InventarioController::class, 'create'])->name('inventario.create');
    Route::post('inventario', [InventarioController::class, 'store'])->name('inventario.store');

    Route::get('clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('clientes/{user}', [ClienteController::class, 'show'])->name('clientes.show');

    Route::get('ventas', [AdminVentaController::class, 'index'])->name('ventas.index');
    Route::get('ventas/crear', [AdminVentaController::class, 'create'])->name('ventas.create');
    Route::post('ventas', [AdminVentaController::class, 'store'])->name('ventas.store');
    Route::get('ventas/{venta}', [AdminVentaController::class, 'show'])->name('ventas.show');
    Route::patch('ventas/{venta}', [AdminVentaController::class, 'update'])->name('ventas.update');
});

require __DIR__.'/auth.php';

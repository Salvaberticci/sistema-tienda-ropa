<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View
    {
        $carrito = session()->get('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('carrito.index');
        }

        $ids = array_keys($carrito);
        $productos = Producto::activos()->whereIn('id', $ids)->get()->keyBy('id');
        $total = 0;

        foreach ($carrito as $id => $cantidad) {
            if (isset($productos[$id])) {
                $total += $productos[$id]->precio * $cantidad;
            }
        }

        return view('checkout.index', compact('carrito', 'productos', 'total'));
    }

    public function store(Request $request): RedirectResponse
    {
        $carrito = session()->get('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('carrito.index');
        }

        $ids = array_keys($carrito);
        $productos = Producto::activos()->whereIn('id', $ids)->get()->keyBy('id');

        $total = 0;
        $items = [];

        foreach ($carrito as $id => $cantidad) {
            $producto = $productos[$id] ?? null;
            if (!$producto || $producto->stock < $cantidad) {
                return redirect()->route('checkout.index')->with('error', "Stock insuficiente para {$producto?->nombre}.");
            }
            $subtotal = $producto->precio * $cantidad;
            $total += $subtotal;
            $items[] = compact('producto', 'cantidad', 'subtotal');
        }

        $venta = Venta::create([
            'user_id' => $request->user()->id,
            'total' => $total,
            'estado' => 'pendiente',
        ]);

        foreach ($items as $item) {
            $producto = $item['producto'];
            $venta->productos()->create([
                'producto_id' => $producto->id,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $producto->precio,
                'subtotal' => $item['subtotal'],
            ]);
            $producto->decrement('stock', $item['cantidad']);
        }

        session()->forget('carrito');

        return redirect()->route('checkout.confirmacion', $venta);
    }

    public function confirmacion(Venta $venta): View
    {
        if ($venta->user_id !== request()->user()->id) {
            abort(403);
        }
        $venta->load('productos.producto');
        return view('checkout.confirmacion', compact('venta'));
    }
}

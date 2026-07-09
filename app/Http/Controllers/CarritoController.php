<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarritoController extends Controller
{
    public function index(): View
    {
        $carrito = session()->get('carrito', []);
        $productos = [];

        if (!empty($carrito)) {
            $ids = array_keys($carrito);
            $productos = Producto::activos()->whereIn('id', $ids)->get()->keyBy('id');
        }

        $total = 0;
        foreach ($carrito as $id => $cantidad) {
            if (isset($productos[$id])) {
                $total += $productos[$id]->precio * $cantidad;
            }
        }

        return view('carrito.index', compact('carrito', 'productos', 'total'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1|max:99',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        if (!$producto->activo || $producto->stock < 1) {
            return back()->with('error', 'Este producto no está disponible.');
        }

        $carrito = session()->get('carrito', []);
        $productoId = $producto->id;
        $cantidad = min((int) $request->cantidad, $producto->stock);

        if (isset($carrito[$productoId])) {
            $carrito[$productoId] = min($carrito[$productoId] + $cantidad, $producto->stock);
        } else {
            $carrito[$productoId] = $cantidad;
        }

        session()->put('carrito', $carrito);

        return redirect()->route('carrito.index')->with('success', 'Producto agregado al carrito.');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'cantidad' => 'required|integer|min=0|max:99',
        ]);

        $carrito = session()->get('carrito', []);

        if (!isset($carrito[$id])) {
            return redirect()->route('carrito.index')->with('error', 'Producto no encontrado en el carrito.');
        }

        $producto = Producto::find($id);

        if ((int) $request->cantidad < 1) {
            unset($carrito[$id]);
        } else {
            $max = $producto ? $producto->stock : 99;
            $carrito[$id] = min((int) $request->cantidad, $max);
        }

        session()->put('carrito', $carrito);

        return redirect()->route('carrito.index')->with('success', 'Carrito actualizado.');
    }

    public function destroy($id): RedirectResponse
    {
        $carrito = session()->get('carrito', []);

        unset($carrito[$id]);
        session()->put('carrito', $carrito);

        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito.');
    }
}

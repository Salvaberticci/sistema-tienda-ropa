<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VentaController extends Controller
{
    public function index(): View
    {
        $ventas = Venta::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.ventas.index', compact('ventas'));
    }

    public function create(): View
    {
        $productos = Producto::activos()->with('categoria')->orderBy('nombre')->get();
        return view('admin.ventas.create', compact('productos'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.producto_id' => 'required|exists:productos,id',
            'items.*.cantidad' => 'required|integer|min:1',
            'cliente_nombre' => 'nullable|string|max:255',
        ]);

        $total = 0;
        $items = [];

        foreach ($request->items as $item) {
            $producto = Producto::findOrFail($item['producto_id']);
            $cantidad = min((int) $item['cantidad'], $producto->stock);

            if ($cantidad < 1) {
                return back()->with('error', "Stock insuficiente para {$producto->nombre}.")->withInput();
            }

            $subtotal = $producto->precio * $cantidad;
            $total += $subtotal;
            $items[] = compact('producto', 'cantidad', 'subtotal');
        }

        $venta = Venta::create([
            'user_id' => $request->user()->id,
            'total' => $total,
            'estado' => 'confirmado',
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

        return redirect()->route('admin.ventas.show', $venta)
            ->with('success', 'Venta registrada exitosamente.');
    }

    public function show(Venta $venta): View
    {
        $venta->load(['user', 'productos.producto']);
        return view('admin.ventas.show', compact('venta'));
    }

    public function update(Request $request, Venta $venta): RedirectResponse
    {
        $request->validate([
            'estado' => 'required|in:pendiente,confirmado,enviado,entregado,cancelado',
        ]);

        $venta->update(['estado' => $request->estado]);

        return redirect()->route('admin.ventas.index')->with('success', 'Estado de venta actualizado.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MovimientoInventario;
use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class InventarioController extends Controller
{
    public function index(): View
    {
        $movimientos = MovimientoInventario::with('producto', 'usuario')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.inventario.index', compact('movimientos'));
    }

    public function create(): View
    {
        $productos = Producto::orderBy('nombre')->get();
        return view('admin.inventario.create', compact('productos'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'producto_id' => ['required', 'exists:productos,id'],
            'tipo' => ['required', 'in:entrada,salida'],
            'cantidad' => ['required', 'integer', 'min:1'],
            'motivo' => ['nullable', 'string', 'max:500'],
        ]);

        $producto = Producto::findOrFail($validated['producto_id']);

        if ($validated['tipo'] === 'salida' && $producto->stock < $validated['cantidad']) {
            return back()->withErrors(['cantidad' => 'No hay suficiente stock. Stock actual: ' . $producto->stock])
                ->withInput();
        }

        $validated['user_id'] = Auth::id();

        MovimientoInventario::create($validated);

        if ($validated['tipo'] === 'entrada') {
            $producto->increment('stock', $validated['cantidad']);
        } else {
            $producto->decrement('stock', $validated['cantidad']);
        }

        return redirect()->route('admin.inventario.index')
            ->with('success', 'Movimiento registrado exitosamente.');
    }
}

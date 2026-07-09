<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\View\View;

class PedidoController extends Controller
{
    public function index(): View
    {
        $ventas = Venta::where('user_id', request()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('pedidos.index', compact('ventas'));
    }

    public function show(Venta $venta): View
    {
        if ($venta->user_id !== request()->user()->id) {
            abort(403);
        }
        $venta->load('productos.producto');
        return view('pedidos.show', compact('venta'));
    }
}

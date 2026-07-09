<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;

class FacturaController extends Controller
{
    public function download(Venta $venta)
    {
        if (auth()->user()->role !== 'admin' && $venta->user_id !== auth()->id()) {
            abort(403);
        }

        $venta->load(['user', 'productos.producto']);

        $pdf = Pdf::loadView('factura', compact('venta'));

        return $pdf->download("factura-{$venta->id}.pdf");
    }

    public function view(Venta $venta)
    {
        if (auth()->user()->role !== 'admin' && $venta->user_id !== auth()->id()) {
            abort(403);
        }

        $venta->load(['user', 'productos.producto']);

        $pdf = Pdf::loadView('factura', compact('venta'));

        return $pdf->stream("factura-{$venta->id}.pdf");
    }
}

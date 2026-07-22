<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReporteController extends Controller
{
    public function mensual(Request $request): View
    {
        $mes = $request->get('mes', now()->format('Y-m'));

        return view('admin.ventas.reporte-mensual-form', compact('mes'));
    }

    public function downloadMensual(Request $request)
    {
        $mes = $request->get('mes', now()->format('Y-m'));

        $fecha = Carbon::parse($mes . '-01');
        $inicio = $fecha->copy()->startOfMonth();
        $fin = $fecha->copy()->endOfMonth();

        $ventas = Venta::with('user', 'productos.producto')
            ->whereBetween('created_at', [$inicio, $fin])
            ->where('estado', '!=', 'cancelado')
            ->orderBy('created_at')
            ->get();

        $totalMes = $ventas->sum('total');
        $cantidadVentas = $ventas->count();
        $ventasPorDia = $ventas->groupBy(fn($v) => $v->created_at->format('Y-m-d'));

        $pdf = Pdf::loadView('admin.ventas.reporte-mensual', compact(
            'ventas', 'totalMes', 'cantidadVentas', 'ventasPorDia', 'fecha'
        ));

        return $pdf->download("reporte-ventas-{$mes}.pdf");
    }
}

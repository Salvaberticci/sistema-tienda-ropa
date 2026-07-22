<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CierreDiario;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CierreDiarioController extends Controller
{
    public function index(): View
    {
        $cierres = CierreDiario::with('user')
            ->orderBy('fecha', 'desc')
            ->paginate(20);

        return view('admin.cierres.index', compact('cierres'));
    }

    public function pendiente(): JsonResponse
    {
        $ultimoCierre = CierreDiario::latest('fecha')->first();

        if (!$ultimoCierre) {
            $fechaPendiente = today()->subDay();
        } else {
            $fechaPendiente = $ultimoCierre->fecha->addDay();
        }

        if ($fechaPendiente->isToday()) {
            return response()->json(['pendiente' => false]);
        }

        $ventas = Venta::whereDate('created_at', $fechaPendiente)
            ->where('estado', '!=', 'cancelado')
            ->count();

        if ($ventas === 0) {
            return response()->json(['pendiente' => false]);
        }

        return response()->json([
            'pendiente' => true,
            'fecha' => $fechaPendiente->format('Y-m-d'),
            'fecha_formateada' => $fechaPendiente->isoFormat('D [de] MMMM [de] YYYY'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $fecha = $request->fecha ? Carbon::parse($request->fecha) : today()->subDay();

        $cierreExistente = CierreDiario::where('fecha', $fecha->toDateString())->first();
        if ($cierreExistente) {
            return redirect()->route('admin.cierres.index')
                ->with('error', "El día {$fecha->isoFormat('D [de] MMMM')} ya tiene un cierre registrado.");
        }

        $ventas = Venta::with('user', 'productos.producto')
            ->whereDate('created_at', $fecha)
            ->where('estado', '!=', 'cancelado')
            ->orderBy('created_at')
            ->get();

        $totalVentas = $ventas->sum('total');
        $cantidadVentas = $ventas->count();

        $pdf = Pdf::loadView('admin.cierres.pdf', compact('ventas', 'totalVentas', 'cantidadVentas', 'fecha'));
        $pdfPath = "cierres/cierre-{$fecha->format('Y-m-d')}.pdf";
        Storage::put($pdfPath, $pdf->output());

        CierreDiario::create([
            'fecha' => $fecha,
            'total_ventas' => $totalVentas,
            'cantidad_ventas' => $cantidadVentas,
            'user_id' => Auth::id(),
            'pdf_path' => $pdfPath,
        ]);

        return redirect()->route('admin.cierres.index')
            ->with('success', "Cierre del {$fecha->isoFormat('D [de] MMMM [de] YYYY')} realizado con éxito.");
    }

    public function download(CierreDiario $cierre)
    {
        if (!$cierre->pdf_path || !Storage::exists($cierre->pdf_path)) {
            $ventas = Venta::with('user', 'productos.producto')
                ->whereDate('created_at', $cierre->fecha)
                ->where('estado', '!=', 'cancelado')
                ->orderBy('created_at')
                ->get();

            $totalVentas = $cierre->total_ventas;
            $cantidadVentas = $cierre->cantidad_ventas;
            $fecha = $cierre->fecha;

            $pdf = Pdf::loadView('admin.cierres.pdf', compact('ventas', 'totalVentas', 'cantidadVentas', 'fecha'));
            return $pdf->download("cierre-{$cierre->fecha->format('Y-m-d')}.pdf");
        }

        return Storage::download($cierre->pdf_path, "cierre-{$cierre->fecha->format('Y-m-d')}.pdf");
    }
}

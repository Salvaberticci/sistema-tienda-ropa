<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cierre Diario - {{ $fecha->isoFormat('D [de] MMMM [de] YYYY') }}</title>
    <style>
        body {
            font-family: 'Inter', 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #d4c5a9;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-family: 'Playfair Display', 'Georgia', serif;
            font-size: 24px;
            color: #8b7355;
            margin: 0 0 5px;
        }
        .header p {
            color: #888;
            margin: 2px 0;
            font-size: 10px;
        }
        .resumen {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 15px 20px;
            background: #f5f0eb;
            border-radius: 5px;
        }
        .resumen-item {
            text-align: center;
        }
        .resumen-item strong {
            display: block;
            font-size: 18px;
            color: #8b7355;
        }
        .resumen-item span {
            font-size: 10px;
            color: #888;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background-color: #f5f0eb;
            color: #8b7355;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 6px 8px;
            text-align: left;
            border-bottom: 2px solid #d4c5a9;
        }
        td {
            padding: 5px 8px;
            border-bottom: 1px solid #eee;
            font-size: 10px;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .total-row td {
            font-weight: bold;
            font-size: 13px;
            border-top: 2px solid #d4c5a9;
            border-bottom: none;
            padding-top: 8px;
        }
        .footer {
            text-align: center;
            color: #aaa;
            font-size: 9px;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Hechizos</h1>
        <p>Diseños y Complementos</p>
        <p>Av. Independencia, Calle 3 Miranda — C.C. Plaza Marina, 2do piso, Local 30</p>
        <p style="margin-top:6px; font-size:14px; font-weight:bold; color:#333;">
            CIERRE DIARIO — {{ $fecha->isoFormat('dddd D [de] MMMM [de] YYYY') }}
        </p>
    </div>

    <div class="resumen">
        <div class="resumen-item">
            <strong>${{ number_format($totalVentas, 2) }}</strong>
            <span>Total vendido</span>
        </div>
        <div class="resumen-item">
            <strong>{{ $cantidadVentas }}</strong>
            <span>Ventas realizadas</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Hora</th>
                <th># Venta</th>
                <th>Cliente</th>
                <th>Productos</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ventas as $venta)
                <tr>
                    <td>{{ $venta->created_at->format('h:i A') }}</td>
                    <td>#{{ $venta->id }}</td>
                    <td>{{ $venta->user->name }}</td>
                    <td>
                        @foreach ($venta->productos as $item)
                            {{ $item->producto->nombre }} x{{ $item->cantidad }}@if (!$loop->last), @endif
                        @endforeach
                    </td>
                    <td class="text-right">${{ number_format($venta->total, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 20px; color: #aaa;">
                        No se registraron ventas en este día.
                    </td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4" class="text-right">TOTAL DEL DÍA</td>
                <td class="text-right">${{ number_format($totalVentas, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Reporte generado el {{ now()->format('d/m/Y h:i A') }}</p>
        <p>Hechizos Diseños y Complementos &copy; {{ $fecha->year }}</p>
    </div>
</body>
</html>

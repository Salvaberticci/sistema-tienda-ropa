<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Factura #{{ $venta->id }}</title>
    <style>
        body {
            font-family: 'Inter', 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #d4c5a9;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-family: 'Playfair Display', 'Georgia', serif;
            font-size: 28px;
            color: #8b7355;
            margin: 0 0 5px;
        }
        .header p {
            color: #888;
            margin: 2px 0;
            font-size: 11px;
        }
        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .info-box {
            width: 48%;
        }
        .info-box h3 {
            font-size: 13px;
            color: #8b7355;
            margin: 0 0 5px;
            border-bottom: 1px solid #eee;
            padding-bottom: 3px;
        }
        .info-box p {
            margin: 2px 0;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background-color: #f5f0eb;
            color: #8b7355;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 10px;
            text-align: left;
            border-bottom: 2px solid #d4c5a9;
        }
        td {
            padding: 8px 10px;
            border-bottom: 1px solid #eee;
            font-size: 11px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .total-row td {
            font-weight: bold;
            font-size: 14px;
            border-top: 2px solid #d4c5a9;
            border-bottom: none;
            padding-top: 10px;
        }
        .footer {
            text-align: center;
            color: #aaa;
            font-size: 10px;
            border-top: 1px solid #eee;
            padding-top: 15px;
            margin-top: 30px;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-confirmado { background: #dbeafe; color: #1d4ed8; }
        .badge-pendiente { background: #fef3c7; color: #b45309; }
        .badge-enviado { background: #f3e8ff; color: #7c3aed; }
        .badge-entregado { background: #d1fae5; color: #047857; }
        .badge-cancelado { background: #fee2e2; color: #b91c1c; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Hechizos</h1>
        <p>Diseños y Complementos</p>
        <p>Av. Independencia, Calle 3 Miranda — C.C. Plaza Marina, 2do piso, Local 30</p>
        <p>Municipio Trujillo, Estado Trujillo</p>
        <p style="margin-top:8px; font-size:13px; font-weight:bold; color:#333;">FACTURA N° {{ $venta->id }}</p>
    </div>

    <div class="info-section">
        <div class="info-box">
            <h3>Cliente</h3>
            <p><strong>{{ $venta->user->name }}</strong></p>
            <p>{{ $venta->user->email }}</p>
            <p>{{ $venta->user->telefono ?? '' }}</p>
            <p>{{ $venta->user->direccion ?? '' }}</p>
        </div>
        <div class="info-box" style="text-align:right;">
            <h3>Detalles</h3>
            <p><strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y h:i A') }}</p>
            <p><strong>Estado:</strong> <span class="badge badge-{{ $venta->estado }}">{{ ucfirst($venta->estado) }}</span></p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th class="text-center">Cantidad</th>
                <th class="text-right">Precio Unit.</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($venta->productos as $item)
                <tr>
                    <td>{{ $item->producto->nombre }}</td>
                    <td class="text-center">{{ $item->cantidad }}</td>
                    <td class="text-right">${{ number_format($item->precio_unitario, 2) }}</td>
                    <td class="text-right">${{ number_format($item->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3" class="text-right">TOTAL</td>
                <td class="text-right">${{ number_format($venta->total, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Gracias por su compra</p>
        <p>Hechizos Diseños y Complementos &copy; {{ date('Y') }}</p>
    </div>
</body>
</html>

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'categoria_id',
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'stock_minimo',
        'imagen',
        'activo',
    ];

    protected $appends = ['imagen_url'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function getImagenUrlAttribute()
    {
        if ($this->imagen) {
            return Storage::url($this->imagen);
        }
        return null;
    }

    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    public function scopeStockBajo($query)
    {
        return $query->whereColumn('stock', '<=', 'stock_minimo');
    }

    public function scopeMasVendidos($query, $dias = 7, $limite = 4)
    {
        $fecha = now()->subDays($dias);
        $productosIds = \DB::table('venta_productos')
            ->join('ventas', 'venta_productos.venta_id', '=', 'ventas.id')
            ->where('ventas.created_at', '>=', $fecha)
            ->where('ventas.estado', '!=', 'cancelado')
            ->select('venta_productos.producto_id', \DB::raw('SUM(venta_productos.cantidad) as total'))
            ->groupBy('venta_productos.producto_id')
            ->orderBy('total', 'desc')
            ->take($limite)
            ->pluck('producto_id');

        if ($productosIds->isEmpty()) {
            return $query->whereNull('id');
        }

        return $query->whereIn('id', $productosIds);
    }
}

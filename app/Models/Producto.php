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
}

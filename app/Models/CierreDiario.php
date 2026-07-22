<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CierreDiario extends Model
{
    protected $table = 'cierres_diarios';

    protected $fillable = [
        'fecha',
        'total_ventas',
        'cantidad_ventas',
        'user_id',
        'pdf_path',
    ];

    protected $casts = [
        'fecha' => 'date',
        'total_ventas' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

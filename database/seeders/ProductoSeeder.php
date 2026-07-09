<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            ['nombre' => 'Collar artesanal de mostacillas', 'categoria_id' => 1, 'precio' => 12.50, 'stock' => 15, 'stock_minimo' => 5, 'descripcion' => 'Collar artesanal hecho a mano con mostacillas de colores.'],
            ['nombre' => 'Collar de perlas importadas', 'categoria_id' => 1, 'precio' => 25.00, 'stock' => 8, 'stock_minimo' => 3],
            ['nombre' => 'Pulsera de cuero tejido', 'categoria_id' => 2, 'precio' => 8.75, 'stock' => 20, 'stock_minimo' => 5],
            ['nombre' => 'Pulsera de piedras naturales', 'categoria_id' => 2, 'precio' => 15.00, 'stock' => 12, 'stock_minimo' => 4],
            ['nombre' => 'Máscara decorativa tradicional', 'categoria_id' => 3, 'precio' => 35.00, 'stock' => 3, 'stock_minimo' => 2, 'descripcion' => 'Máscara artesanal típica de la región andina.'],
            ['nombre' => 'Cesta tejida a mano', 'categoria_id' => 3, 'precio' => 22.00, 'stock' => 6, 'stock_minimo' => 3],
            ['nombre' => 'Llavero artesanal', 'categoria_id' => 4, 'precio' => 5.00, 'stock' => 30, 'stock_minimo' => 10],
            ['nombre' => 'Bufanda importada', 'categoria_id' => 5, 'precio' => 18.50, 'stock' => 10, 'stock_minimo' => 5],
            ['nombre' => 'Set de tazas decorativas', 'categoria_id' => 7, 'precio' => 28.00, 'stock' => 4, 'stock_minimo' => 2],
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}

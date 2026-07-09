<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Collares', 'descripcion' => 'Collares artesanales e importados'],
            ['nombre' => 'Pulseras', 'descripcion' => 'Pulseras de diferentes estilos y materiales'],
            ['nombre' => 'Artesanías', 'descripcion' => 'Artesanías tradicionales venezolanas'],
            ['nombre' => 'Accesorios', 'descripcion' => 'Accesorios variados para dama y caballero'],
            ['nombre' => 'Ropa', 'descripcion' => 'Prendas de vestir importadas'],
            ['nombre' => 'Importados', 'descripcion' => 'Artículos importados de alta calidad'],
            ['nombre' => 'Decoración', 'descripcion' => 'Artículos para decoración del hogar'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}

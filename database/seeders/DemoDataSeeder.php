<?php

namespace Database\Seeders;

use App\Models\MovimientoInventario;
use App\Models\Producto;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Cliente demo
        $cliente = User::create([
            'name' => 'María García',
            'email' => 'maria@test.com',
            'password' => bcrypt('password'),
            'role' => 'cliente',
            'cedula' => 'V-12345678',
            'telefono' => '+58 412-1234567',
            'direccion' => 'Av. Independencia, Edif. Central, Piso 3, Trujillo',
        ]);

        $cliente2 = User::create([
            'name' => 'Carlos Mendoza',
            'email' => 'carlos@test.com',
            'password' => bcrypt('password'),
            'role' => 'cliente',
            'cedula' => 'V-87654321',
            'telefono' => '+58 414-7654321',
            'direccion' => 'Urb. Las Flores, Calle 5, Casa 12, Trujillo',
        ]);

        // Más productos
        $nuevos = [
            ['nombre' => 'Anillo de plata artesanal', 'categoria_id' => 4, 'precio' => 19.99, 'stock' => 10, 'stock_minimo' => 3, 'descripcion' => 'Anillo de plata 925 con diseño artesanal andino.'],
            ['nombre' => 'Collar de mostacillas arcoíris', 'categoria_id' => 1, 'precio' => 14.50, 'stock' => 18, 'stock_minimo' => 5, 'descripcion' => 'Collar colorido de mostacillas con patrón arcoíris.'],
            ['nombre' => 'Pulsera de hilo encerado', 'categoria_id' => 2, 'precio' => 6.99, 'stock' => 25, 'stock_minimo' => 8],
            ['nombre' => 'Sombrero importado', 'categoria_id' => 5, 'precio' => 32.00, 'stock' => 5, 'stock_minimo' => 2, 'descripcion' => 'Sombrero de ala ancha importado de Italia.'],
            ['nombre' => 'Portarretrato decorativo', 'categoria_id' => 7, 'precio' => 16.00, 'stock' => 7, 'stock_minimo' => 3],
            ['nombre' => 'Jarrón artesanal', 'categoria_id' => 3, 'precio' => 42.00, 'stock' => 2, 'stock_minimo' => 1, 'descripcion' => 'Jarrón de barro pintado a mano.'],
            ['nombre' => 'Aritos de mostacillas', 'categoria_id' => 4, 'precio' => 7.50, 'stock' => 22, 'stock_minimo' => 6],
            ['nombre' => 'Camisa bordada', 'categoria_id' => 5, 'precio' => 28.00, 'stock' => 8, 'stock_minimo' => 3, 'descripcion' => 'Camisa de lino con bordados tradicionales.'],
            ['nombre' => 'Bolso tejido', 'categoria_id' => 6, 'precio' => 35.00, 'stock' => 4, 'stock_minimo' => 2, 'descripcion' => 'Bolso artesanal tejido en fibra natural.'],
            ['nombre' => 'Poncho andino', 'categoria_id' => 5, 'precio' => 55.00, 'stock' => 3, 'stock_minimo' => 1, 'descripcion' => 'Poncho tradicional andino de lana de oveja.'],
            ['nombre' => 'Figura decorativa de cerámica', 'categoria_id' => 7, 'precio' => 24.00, 'stock' => 6, 'stock_minimo' => 2],
            ['nombre' => 'Collar de conchas marinas', 'categoria_id' => 1, 'precio' => 18.00, 'stock' => 1, 'stock_minimo' => 2, 'descripcion' => 'Collar de conchas marinas importadas del Caribe.'],
        ];

        foreach ($nuevos as $p) {
            Producto::create($p);
        }

        // Movimientos de inventario (entradas)
        $admin = User::where('role', 'admin')->first();
        $productos = Producto::all();
        $motivos = ['Compra a proveedor', 'Reabastecimiento de tienda', 'Nuevo lote de producción', 'Devolución de cliente'];

        foreach ($productos as $producto) {
            MovimientoInventario::create([
                'producto_id' => $producto->id,
                'user_id' => $admin->id,
                'tipo' => 'entrada',
                'cantidad' => $producto->stock,
                'motivo' => $motivos[array_rand($motivos)],
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()->subDays(rand(1, 30)),
            ]);
        }

        // Algunas salidas (ventas presenciales)
        MovimientoInventario::create([
            'producto_id' => 1, 'user_id' => $admin->id, 'tipo' => 'salida', 'cantidad' => 2,
            'motivo' => 'Venta presencial', 'created_at' => now()->subDays(5),
        ]);
        MovimientoInventario::create([
            'producto_id' => 3, 'user_id' => $admin->id, 'tipo' => 'salida', 'cantidad' => 3,
            'motivo' => 'Venta presencial', 'created_at' => now()->subDays(3),
        ]);
        MovimientoInventario::create([
            'producto_id' => 7, 'user_id' => $admin->id, 'tipo' => 'salida', 'cantidad' => 5,
            'motivo' => 'Venta al por mayor', 'created_at' => now()->subDays(7),
        ]);
        MovimientoInventario::create([
            'producto_id' => 6, 'user_id' => $admin->id, 'tipo' => 'salida', 'cantidad' => 1,
            'motivo' => 'Venta presencial', 'created_at' => now()->subDays(1),
        ]);

        // Ventas (pedidos online)
        $venta1 = Venta::create([
            'user_id' => $cliente->id,
            'total' => 43.50,
            'estado' => 'entregado',
            'created_at' => now()->subDays(15),
            'updated_at' => now()->subDays(10),
        ]);
        $venta1->productos()->createMany([
            ['producto_id' => 1, 'cantidad' => 2, 'precio_unitario' => 12.50, 'subtotal' => 25.00, 'created_at' => now()->subDays(15)],
            ['producto_id' => 7, 'cantidad' => 1, 'precio_unitario' => 5.00, 'subtotal' => 5.00, 'created_at' => now()->subDays(15)],
            ['producto_id' => 3, 'cantidad' => 2, 'precio_unitario' => 6.99, 'subtotal' => 13.98, 'created_at' => now()->subDays(15)],
        ]);
        // Actualizar stock por venta
        Producto::find(1)->decrement('stock', 2);
        Producto::find(7)->decrement('stock', 1);
        Producto::find(3)->decrement('stock', 2);

        $venta2 = Venta::create([
            'user_id' => $cliente2->id,
            'total' => 77.50,
            'estado' => 'confirmado',
            'created_at' => now()->subDays(8),
            'updated_at' => now()->subDays(7),
        ]);
        $venta2->productos()->createMany([
            ['producto_id' => 4, 'cantidad' => 1, 'precio_unitario' => 15.00, 'subtotal' => 15.00, 'created_at' => now()->subDays(8)],
            ['producto_id' => 2, 'cantidad' => 2, 'precio_unitario' => 25.00, 'subtotal' => 50.00, 'created_at' => now()->subDays(8)],
            ['producto_id' => 13, 'cantidad' => 1, 'precio_unitario' => 12.50, 'subtotal' => 12.50, 'created_at' => now()->subDays(8)],
        ]);
        Producto::find(4)->decrement('stock', 1);
        Producto::find(2)->decrement('stock', 2);
        Producto::find(13)->decrement('stock', 1);

        $venta3 = Venta::create([
            'user_id' => $cliente->id,
            'total' => 63.00,
            'estado' => 'pendiente',
            'created_at' => now()->subDay(),
        ]);
        $venta3->productos()->createMany([
            ['producto_id' => 8, 'cantidad' => 1, 'precio_unitario' => 28.00, 'subtotal' => 28.00, 'created_at' => now()->subDay()],
            ['producto_id' => 20, 'cantidad' => 1, 'precio_unitario' => 35.00, 'subtotal' => 35.00, 'created_at' => now()->subDay()],
        ]);
        Producto::find(8)->decrement('stock', 1);
        Producto::find(20)->decrement('stock', 1);

        $venta4 = Venta::create([
            'user_id' => $cliente2->id,
            'total' => 47.50,
            'estado' => 'enviado',
            'created_at' => now()->subDays(3),
            'updated_at' => now()->subDays(2),
        ]);
        $venta4->productos()->createMany([
            ['producto_id' => 5, 'cantidad' => 1, 'precio_unitario' => 35.00, 'subtotal' => 35.00, 'created_at' => now()->subDays(3)],
            ['producto_id' => 16, 'cantidad' => 1, 'precio_unitario' => 12.50, 'subtotal' => 12.50, 'created_at' => now()->subDays(3)],
        ]);
        Producto::find(5)->decrement('stock', 1);
        Producto::find(16)->decrement('stock', 1);

        $venta5 = Venta::create([
            'user_id' => 1,
            'total' => 55.00,
            'estado' => 'confirmado',
            'created_at' => now()->subDays(2),
        ]);
        $venta5->productos()->create([
            'producto_id' => 21, 'cantidad' => 1, 'precio_unitario' => 55.00, 'subtotal' => 55.00,
            'created_at' => now()->subDays(2),
        ]);
        Producto::find(21)->decrement('stock', 1);
    }
}

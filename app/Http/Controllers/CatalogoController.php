<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\View\View;

class CatalogoController extends Controller
{
    public function index(): View
    {
        $categorias = Categoria::activas()->get();
        $productos = Producto::activos()
            ->with('categoria')
            ->when(request('categoria'), function ($q, $catId) {
                return $q->where('categoria_id', $catId);
            })
            ->when(request('busqueda'), function ($q, $search) {
                return $q->where('nombre', 'like', "%{$search}%")
                    ->orWhere('descripcion', 'like', "%{$search}%");
            })
            ->orderBy('nombre')
            ->paginate(12);

        return view('catalogo.index', compact('productos', 'categorias'));
    }

    public function show(Producto $producto): View
    {
        if (!$producto->activo) {
            abort(404);
        }

        $relacionados = Producto::activos()
            ->where('categoria_id', $producto->categoria_id)
            ->where('id', '!=', $producto->id)
            ->limit(4)
            ->get();

        return view('catalogo.show', compact('producto', 'relacionados'));
    }
}

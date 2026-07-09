<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class ClienteController extends Controller
{
    public function index(): View
    {
        $clientes = User::where('role', 'cliente')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.clientes.index', compact('clientes'));
    }

    public function show(User $user): View
    {
        if ($user->role !== 'cliente') {
            abort(404);
        }

        return view('admin.clientes.show', compact('user'));
    }
}

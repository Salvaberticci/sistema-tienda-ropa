<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@hechizos.com',
            'password' => Hash::make('password'),
            'cedula' => 'V-12345678',
            'telefono' => '+58 412-1234567',
            'role' => 'admin',
        ]);
    }
}

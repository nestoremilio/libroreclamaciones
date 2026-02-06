<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Verificar si ya existe para no duplicar
        if (!User::where('email', 'admin@pnp.gob.pe')->exists()) {
            User::create([
                'name' => 'Administrador',
                'email' => 'admin@pnp.gob.pe',
                'password' => Hash::make('sistemas2026'),
            ]);
        }
    }
}
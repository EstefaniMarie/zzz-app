<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctores;

class DoctoresSeeder extends Seeder
{
    public function run()
    {
        $usuarios = User::where('idRol', 3)->pluck('id')->all();
        foreach ($usuarios as $usuarioId) {
            Doctores::factory()->withUsuarios([$usuarioId])->create();
        }
    }
}
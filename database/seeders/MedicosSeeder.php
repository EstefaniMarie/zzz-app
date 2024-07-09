<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Medicos;

class MedicosSeeder extends Seeder
{
    public function run()
    {
        $usuarios = User::where('idRol', 3)->pluck('id')->all();
        foreach ($usuarios as $usuarioId) {
            Medicos::factory()->withUsuarios([$usuarioId])->create();
        }
    }
}
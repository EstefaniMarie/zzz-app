<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Farmaceutico;
use App\Models\User;
use Spatie\Permission\Models\Role;

class FarmaceuticoSeeder extends Seeder
{
    public function run()
    {
        $usuarios = User::where('role_id', 5)->pluck('id')->all();
        foreach ($usuarios as $usuarioId) {
            Farmaceutico::factory()->withUsuarios([$usuarioId])->create();
        }
    }
}
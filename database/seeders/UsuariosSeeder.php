<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Factories\UsuariosFactory;
use Database\Factories\FarmaceuticoFactory;

class UsuariosSeeder extends Seeder
{    
    public function run(): void
    {
        UsuariosFactory::new()->count(20)->create();
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneroSeeder extends Seeder
{    
    public function run(): void
    {
        DB::table('genero')->insert([
            ['tipo' => '1',
            'descripcion' => 'Femenino'],
            ['tipo' => '2',
            'descripcion' => 'Masculino'],
        ]);
    }
}
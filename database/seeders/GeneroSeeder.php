<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneroSeeder extends Seeder
{    
    public function run(): void
    {
        DB::table('genero')->insert([
            ['descripcion' => 'Masculino'],
            ['descripcion' => 'Femenino'],
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParentescoSeeder extends Seeder
{    
    public function run(): void
    {
        DB::table('parentesco')->insert([
            ['tipo' => '1',
            'descripcion' => 'Conyuge'],
            ['tipo' => '2',
            'descripcion' => 'Hijo(a)'],
            ['tipo' => '3',
            'descripcion' => 'Madre'],
            ['tipo' => '4',
            'descripcion' => 'Padre'],
        ]);
    }
}
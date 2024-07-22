<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParentescoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('parentescos')->insert([
            ['descripcion' => 'Titular'],
            ['descripcion' => 'Cortesía'],
            ['descripcion' => 'Conyuge'],
            ['descripcion' => 'Hijo(a)'],
            ['descripcion' => 'Madre'],
            ['descripcion' => 'Padre'],
        ]);
    }
}

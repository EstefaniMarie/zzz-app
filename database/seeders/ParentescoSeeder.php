<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParentescoSeeder extends Seeder
{    
    public function run(): void
    {
        DB::table('parentescos')->insert([
            ['codigoParentesco' => 1 ,'descripcion' => 'Conyuge'],
            ['codigoParentesco' => 2 ,'descripcion' => 'Hijo(a)'],
            ['codigoParentesco' => 3 ,'descripcion' => 'Madre'],
            ['codigoParentesco' => 4 ,'descripcion' => 'Padre'],
        ]);
    }
}
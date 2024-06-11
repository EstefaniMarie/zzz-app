<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\OtrosAseguradosConEmpleadosFactory;

class OtrosAseguradosConEmpleadosSeeder extends Seeder
{    
    public function run()
    {
        OtrosAseguradosConEmpleadosFactory::new()->count(100)->create();
    }
}
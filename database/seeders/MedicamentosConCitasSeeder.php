<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\MedicamentosConCitasFactory;

class MedicamentosConCitasSeeder extends Seeder
{    
    public function run()
    {
        MedicamentosConCitasFactory::new()->count(100)->create();
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\MedicamentosFactory;

class MedicamentosSeeder extends Seeder
{    
    public function run()
    {
        MedicamentosFactory::new()->count(100)->create();
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\MedicosConConsultasFactory;

class MedicosConConsultasSeeder extends Seeder
{    
    public function run()
    {
        MedicosConConsultasFactory::new()->count(100)->create();
    }
}
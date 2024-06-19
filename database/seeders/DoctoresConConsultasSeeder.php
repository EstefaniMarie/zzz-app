<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\DoctoresConConsultasFactory;

class DoctoresConConsultasSeeder extends Seeder
{    
    public function run()
    {
        DoctoresConConsultasFactory::new()->count(100)->create();
    }
}
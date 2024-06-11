<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\DoctoresConCitasFactory;

class DoctoresConCitasSeeder extends Seeder
{    
    public function run()
    {
        DoctoresConCitasFactory::new()->count(100)->create();
    }
}
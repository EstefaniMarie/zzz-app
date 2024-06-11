<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\IndicacionesFactory;

class IndicacionesSeeder extends Seeder
{    
    public function run()
    {
        IndicacionesFactory::new()->count(50)->create();
    }
}
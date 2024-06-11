<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\HistorialFactory;

class HistorialSeeder extends Seeder
{    
    public function run()
    {
        HistorialFactory::new()->count(100)->create();
    }
}
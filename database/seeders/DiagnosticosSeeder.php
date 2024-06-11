<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\DiagnosticosFactory;

class DiagnosticosSeeder extends Seeder
{    
    public function run()
    {
        DiagnosticosFactory::new()->count(100)->create();
    }
}
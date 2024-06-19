<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\ConsultaConDiagnosticosFactory;

class ConsultaConDiagnosticosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConsultaConDiagnosticosFactory::new()->count(100)->create();
    }
}

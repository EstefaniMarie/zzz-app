<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\DiagnosticosConTratamientosFactory;

class DiagnosticosConTratamientosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DiagnosticosConTratamientosFactory::new()->count(100)->create();
    }
}

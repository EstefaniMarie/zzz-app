<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\SintomaConDiagnosticoFactory;

class SintomasConDiagnosticosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SintomaConDiagnosticoFactory::new()->count(100)->create();
    }
}

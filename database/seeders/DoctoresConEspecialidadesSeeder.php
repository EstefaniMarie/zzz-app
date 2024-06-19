<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\DoctoresConEspecialidadesFactory;

class DoctoresConEspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DoctoresConEspecialidadesFactory::new()->count(20)->create();
    }
}

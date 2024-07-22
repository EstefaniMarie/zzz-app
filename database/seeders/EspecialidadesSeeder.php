<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\EspecialidadesFactory;

class EspecialidadesSeeder extends Seeder
{
    public function run()
    {
        EspecialidadesFactory::new()->count(10)->create();
    }
}

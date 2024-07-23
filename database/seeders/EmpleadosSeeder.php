<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\EmpleadosFactory;

class EmpleadosSeeder extends Seeder
{
    public function run()
    {
        EmpleadosFactory::new()->count(50)->create();
    }
}

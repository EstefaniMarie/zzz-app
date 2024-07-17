<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\CitasFactory;

class CitasSeeder extends Seeder
{
    public function run()
    {
        CitasFactory::new()->count(1000)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\PersonasFactory;

class PersonasSeeder extends Seeder
{
    public function run()
    {
        PersonasFactory::new()->count(1000)->create();
    }
}

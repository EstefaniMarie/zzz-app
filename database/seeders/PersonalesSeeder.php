<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\PersonalesFactory;

class PersonalesSeeder extends Seeder
{    
    public function run()
    {
        PersonalesFactory::new()->count(100)->create();
    }
}
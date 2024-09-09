<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\SintomasFactory;

class SintomasSeeder extends Seeder
{    
    public function run()
    {
        SintomasFactory::new()->count(100)->create();
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\TratamientosFactory;

class TratamientosSeeder extends Seeder
{    
    public function run()
    {
        TratamientosFactory::new()->count(50)->create();
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\OtrosAseguradosFactory;

class OtrosAseguradosSeeder extends Seeder
{
    public function run()
    {
        OtrosAseguradosFactory::new()->count(30)->create();
    }
}

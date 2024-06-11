<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\FamiliaresFactory;

class FamiliaresSeeder extends Seeder
{    
    public function run()
    {
        FamiliaresFactory::new()->count(100)->create();
    }
}
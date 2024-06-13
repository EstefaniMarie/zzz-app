<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Familiares;
use App\Models\Personales;

class FamiliaresFactory extends Factory
{
    protected $model = Familiares::class;

    public function definition()
    {
        $personales = Personales::pluck('id')->all();
        return [
            'idPersonales' => $this->faker->randomElement($personales),
            'tipo' => $this->faker->text(2000),
            'descripcion' => $this->faker->text(2000)
        ];
    }
}
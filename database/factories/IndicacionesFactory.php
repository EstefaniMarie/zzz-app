<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Indicaciones;
use App\Models\Tratamientos;

class IndicacionesFactory extends Factory
{
    protected $model = Indicaciones::class;

    public function definition()
    {
        return [
            'codigoIndicacion' => $this->faker->numberBetween(0, 500),
            'descripcion' => $this->faker->text(1000),
        ];
    }
}
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
            'tipo' => $this->faker->text(50),
            'descripcion' => $this->faker->text(100),
        ];
    }
}
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tratamientos;


class TratamientosFactory extends Factory
{
    protected $model = Tratamientos::class;

    public function definition()
    {
        return [
            'codigoTratamiento' => $this->faker->unique()->numberBetween(0, 500),
            'descripcion' => $this->faker->text(1000),
        ];
    }
}
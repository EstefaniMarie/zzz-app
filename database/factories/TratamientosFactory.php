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
            'tipo' => $this->faker->text(50),
            'descripcion' => $this->faker->text(1000),
        ];
    }
}
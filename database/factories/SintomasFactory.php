<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Sintomas;
use App\Models\Citas;

class SintomasFactory extends Factory
{
    protected $model = Sintomas::class;

    public function definition()
    {
        return [
            'descripcion' => $this->faker->text(2500),
        ];
    }
}
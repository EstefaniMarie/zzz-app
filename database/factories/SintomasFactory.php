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
        $citas = Citas::pluck('id')->all();
        return [
            'idCita' => $this->faker->randomElement($citas),
            'descripcion' => $this->faker->text(2500),
        ];
    }
}
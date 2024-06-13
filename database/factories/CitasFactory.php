<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Citas;
use App\Models\Personas;

class CitasFactory extends Factory
{
    protected $model = Citas::class;

    public function definition()
    {
        $personas = Personas::pluck('id')->all();
        return [
            'idPersona' => $this->faker->randomElement($personas),
            'fecha' => $this->faker->dateTimeThisMonth(),
            'hora' => $this->faker->time(),
        ];
    }
}
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
        $personas = Personas::pluck('cedula')->all();
        return [
            'cedulaPaciente' => $this->faker->unique()->randomElement($personas),
            'cedulaDoctor' => $this->faker->unique()->randomElement($personas)
        ];
    }
}
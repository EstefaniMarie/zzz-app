<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Consultas;
use App\Models\Sintomas;

class ConsultasConSintomasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $consultas = Consultas::pluck('id')->all();
        $sintomas = Sintomas::pluck('id')->all();
        return [
            'idConsulta' => $this->faker->randomElement($consultas),
            'idSintoma' => $this->faker->randomElement($sintomas),
        ];
    }
}

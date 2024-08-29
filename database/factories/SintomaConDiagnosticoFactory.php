<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Sintomas;
use App\Models\Diagnosticos;

class SintomaConDiagnosticoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sintomas = Sintomas::pluck('id')->all();
        $diagnosticos = Diagnosticos::pluck('id')->all();
        return [
            'idSintoma' => $this->faker->randomElement($sintomas),
            'idDiagnostico' => $this->faker->randomElement($diagnosticos),
        ];
    }
}

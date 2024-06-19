<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Consultas;
use App\Models\Diagnosticos;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConsultaConDiagnosticos>
 */
class ConsultaConDiagnosticosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $consultas = Consultas::pluck('id')->all();
        $diagnosticos = Diagnosticos::pluck('id')->all();
        return [
            'idConsulta' => $this->faker->randomElement($consultas),
            'idDiagnostico' => $this->faker->randomElement($diagnosticos),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tratamientos;
use App\Models\Diagnosticos;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DiagnosticosConTratamientos>
 */
class DiagnosticosConTratamientosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tratamientos = Tratamientos::pluck('id')->all();
        $diagnosticos = Diagnosticos::pluck('id')->all();
        return [
            'idTratamiento' => $this->faker->randomElement($tratamientos),
            'idDiagnostico' => $this->faker->randomElement($diagnosticos),
        ];
    }
}

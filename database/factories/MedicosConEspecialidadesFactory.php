<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Medicos;
use App\Models\Especialidades;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicosConEspecialidades>
 */
class MedicosConEspecialidadesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $medicos = Medicos::pluck('id')->all();
        $especialidades = Especialidades::pluck('id')->all();
        return [
            'idDoctor' => $this->faker->randomElement($medicos),
            'idEspecialidad'=> $this->faker->randomElement($especialidades),
        ];
    }
}

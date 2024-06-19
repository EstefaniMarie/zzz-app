<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Doctores;
use App\Models\Especialidades;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DoctoresConEspecialidades>
 */
class DoctoresConEspecialidadesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $doctores = Doctores::pluck('id')->all();
        $especialidades = Especialidades::pluck('id')->all();
        return [
            'idDoctor' => $this->faker->randomElement($doctores),
            'idEspecialidad'=> $this->faker->randomElement($especialidades),
        ];
    }
}

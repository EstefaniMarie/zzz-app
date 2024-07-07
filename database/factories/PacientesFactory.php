<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Personas;

class PacientesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $persona = Personas::pluck('id')->all();
        return [
            'idPersona' => $this->faker->unique()->randomElement($persona)
        ];
    }
}

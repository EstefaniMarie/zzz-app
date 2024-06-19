<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recipes;
use App\Models\Indicaciones;
use App\Models\Tratamientos;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipes>
 */
class RecipesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tratamientos = Tratamientos::pluck('id')->all();
        $indicaciones = Indicaciones::pluck('id')->all();
        return [
            'idIndicacion' => $this->faker->randomElement($indicaciones),
            'idTratamiento' => $this->faker->randomElement($tratamientos)
        ];
    }
}

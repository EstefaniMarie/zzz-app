<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Consultas;
use App\Models\Citas;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ConsultasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Consultas::class;

    public function definition(): array
    {
        $citas = Citas::pluck("id")->all();
        return [
            'fechaConsulta' => $this->faker->dateTimeBetween('now', '+1 year'),
            'idCita' => $this->faker->randomElement($citas),
        ];
    }
}

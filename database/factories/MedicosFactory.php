<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Medicos;
use App\Models\Usuarios;

class MedicosFactory extends Factory
{
    protected $model = Medicos::class;

    public function definition()
    {
        return [];
    }

    public function withUsuarios($usuarios)
    {
        return $this->state(function () use ($usuarios) {

        $diasDisponibles = ['1', '2', '3', '4', '5'];
        $horasDisponibles = ['1', '2', '3', '4', '5', '6', '7', '8'];

            return [
                'idUsuario' => $this->faker->randomElement($usuarios),
                'colegiatura' => $this->faker->unique()->numberBetween(10000000, 9999999999),
                'diasDisponibles' => implode(', ', $this->faker->randomElements($diasDisponibles, $this->faker->numberBetween(1, 5))),
                'horasDisponibles' => implode(', ', $this->faker->randomElements($horasDisponibles, $this->faker->numberBetween(1, 8))),
            ];
        });
    }
}

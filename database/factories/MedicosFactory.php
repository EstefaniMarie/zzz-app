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
            return [
                'idUsuario' => $this->faker->randomElement($usuarios),
                'colegiatura' => $this->faker->unique()->numberBetween(10000000, 9999999999),
            ];
        });
    }
}

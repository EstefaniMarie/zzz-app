<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Farmaceutico;
use App\Models\User;

class FarmaceuticoFactory extends Factory
{
    protected $model = Farmaceutico::class;

    public function definition()
    {
        return [];
    }

    public function withUsuarios($usuarios)
    {
        return $this->state(function () use ($usuarios) {
            return [
                'idUsuario' => $this->faker->randomElement($usuarios),
            ];
        });
    }
}
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Doctores;
use App\Models\Usuarios;

class DoctoresFactory extends Factory
{
    protected $model = Doctores::class;

    public function definition()
    {
        return [];
    }

    public function withUsuarios($usuarios)
    {
        return $this->state(function () use ($usuarios) {
            return [
                'Usuarios_idUsuarios' => $this->faker->randomElement($usuarios),
            ];
        });
    }
}
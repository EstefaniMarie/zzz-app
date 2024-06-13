<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Personales;
use App\Models\Historial;

class PersonalesFactory extends Factory
{
    protected $model = Personales::class;

    public function definition()
    {
        $historial = Historial::pluck('id')->all();
        return [
            'idHistorialClinico' => $this->faker->randomElement($historial),
            'tipo' => $this->faker->text(2000),
            'descripcion' => $this->faker->text(2000)
        ];
    }
}
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
        $historial = Historial::pluck('idHistorial_Clinico')->all();
        return [
            'idHistorial_Clinico' => $this->faker->randomElement($historial),
            'tipo' => $this->faker->text(2500),
            'descripcion' => $this->faker->text(2500)
        ];
    }
}
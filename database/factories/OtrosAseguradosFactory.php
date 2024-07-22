<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OtrosAsegurados;
use App\Models\Pacientes;

class OtrosAseguradosFactory extends Factory
{
    protected $model = OtrosAsegurados::class;

    public function definition()
    {
        $pacientes = Pacientes::pluck('id')->all();
        return [
            'idPacientes' => $this->faker->randomElement($pacientes),
        ];
    }
}


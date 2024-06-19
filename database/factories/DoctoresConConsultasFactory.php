<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DoctoresConConsultas;
use App\Models\Doctores;
use App\Models\Consultas;

class DoctoresConConsultasFactory extends Factory
{
    protected $model = DoctoresConConsultas::class;

    public function definition()
    {
        $doctores = Doctores::pluck('id')->all();
        $citas = Consultas::pluck('id')->all();
        return [
            'idDoctor' => $this->faker->randomElement($doctores),
            'idConsulta' => $this->faker->randomElement($citas),
            'disponibilidad' => false,
        ];
    }
}
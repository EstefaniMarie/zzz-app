<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MedicosConConsultas;
use App\Models\Medicos;
use App\Models\Consultas;

class MedicosConConsultasFactory extends Factory
{
    protected $model = MedicosConConsultas::class;

    public function definition()
    {
        $medicos = Medicos::pluck('id')->all();
        $citas = Consultas::pluck('id')->all();
        return [
            'idMedico' => $this->faker->randomElement($medicos),
            'idConsulta' => $this->faker->randomElement($citas),
            'disponibilidad' => true,
        ];
    }
}

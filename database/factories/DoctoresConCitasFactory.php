<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DoctoresConCitas;
use App\Models\Doctores;
use App\Models\Citas;

class DoctoresConCitasFactory extends Factory
{
    protected $model = DoctoresConCitas::class;

    public function definition()
    {
        $doctores = Doctores::pluck('idDoctores')->all();
        $citas = Citas::pluck('idCitas')->all();
        return [
            'Doctores_idDoctores' => $this->faker->randomElement($doctores),
            'Citas_idCitas' => $this->faker->randomElement($citas),
            'disponibilidad' => false,
        ];
    }
}
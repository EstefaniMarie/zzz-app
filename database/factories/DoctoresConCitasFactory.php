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
        $doctores = Doctores::pluck('id')->all();
        $citas = Citas::pluck('id')->all();
        return [
            'idDoctor' => $this->faker->randomElement($doctores),
            'idCita' => $this->faker->randomElement($citas),
            'disponibilidad' => false,
        ];
    }
}
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Especialidades;
use App\Models\Doctores;

class EspecialidadesFactory extends Factory
{
    protected $model = Especialidades::class;

    public function definition()
    {
        $doctores = Doctores::pluck('idDoctores')->all();
        return [
            'Doctores_idDoctores' => $this->faker->randomElement($doctores),
            'descripcion' => $this->faker->text(30),
        ];
    }
}
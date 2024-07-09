<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Especialidades;
use App\Models\Medicos;

class EspecialidadesFactory extends Factory
{
    protected $model = Especialidades::class;

    public function definition()
    {
        $medicos = Medicos::pluck('id')->all();
        return [
            'codigoEspecialidad' => $this->faker->randomNumber(),
            'descripcion' => $this->faker->text(30),
        ];
    }
}
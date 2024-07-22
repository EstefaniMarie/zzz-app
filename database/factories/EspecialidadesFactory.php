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
        return [
            'descripcion' => $this->faker->text(15),
        ];
    }
}

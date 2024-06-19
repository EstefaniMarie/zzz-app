<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OtrosAsegurados;
use App\Models\Personas;
use App\Models\Parentesco;

class OtrosAseguradosFactory extends Factory
{
    protected $model = OtrosAsegurados::class;

    public function definition()
    {
        $pacientes = Personas::pluck('id')->all();
        $parentesco = Parentesco::pluck('id')->all();
        return [
            'idPersona' => $this->faker->randomElement($pacientes),
            'idParentesco' => $this->faker->randomElement($parentesco)
        ];
    }
}
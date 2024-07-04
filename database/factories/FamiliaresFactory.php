<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Familiares;
use App\Models\Personas;
use App\Models\OtrosAsegurados;

class FamiliaresFactory extends Factory
{
    protected $model = Familiares::class;

    public function definition()
    {
        $personas = Personas::pluck('id')->all();
        $otroAsegurado = OtrosAsegurados::pluck('id')->all();
        return [
            'idPersona' => $this->faker->randomElement($personas),
            'idOtroAsegurado' => $this->faker->randomElement($otroAsegurado),
            'tipo' => $this->faker->text(20),
            'descripcion' => $this->faker->text(100)
        ];
    }
}
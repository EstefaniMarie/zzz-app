<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Personales;
use App\Models\Familiares;
use App\Models\Personas;
use App\Models\Historial;

class PersonalesFactory extends Factory
{
    protected $model = Personales::class;

    public function definition()
    {
        $historial = Historial::pluck('id')->all();
        $antecedentesFamiliares = Familiares::pluck('id')->all();
        $personas = Personas::pluck('id')->all();
        return [
            'idHistorialClinico' => $this->faker->randomElement($historial),
            'idPersona' => $this->faker->randomElement($personas),
            'idAntecedenteFamiliar' => $this->faker->randomElement($antecedentesFamiliares),
            'tipo' => $this->faker->text(2000),
            'descripcion' => $this->faker->text(2000)
        ];
    }
}
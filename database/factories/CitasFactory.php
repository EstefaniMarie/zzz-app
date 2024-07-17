<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Citas;
use App\Models\Personas;

class CitasFactory extends Factory
{
    protected $model = Citas::class;

    public function definition()
    {
        $medicos = Personas::whereHas('usuario', function ($query) {
            $query->where('idRol', 3);
        })->pluck('cedula')->all();

        $pacientes = Personas::pluck('cedula')->all();

        return [
            'cedulaPaciente' => $this->faker->randomElement($pacientes),
            'cedulaMedico' => $this->faker->randomElement($medicos)
        ];
    }
}

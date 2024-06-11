<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Historial;
use App\Models\Empleados;

class HistorialFactory extends Factory
{
    protected $model = Historial::class;

    public function definition()
    {
        $pacientes = Empleados::pluck('idEmpleados')->all();
        return [
            'Pacientes_idPacientes' => $this->faker->randomElement($pacientes),
        ];
    }
}
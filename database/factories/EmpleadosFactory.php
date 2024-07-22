<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pacientes;
use App\Models\Empleados;

class EmpleadosFactory extends Factory
{
    protected $model = Empleados::class;

    public function definition()
    {
        $pacientes = Pacientes::pluck('id')->all();
        return [
            'idPacientes' => $this->faker->unique()->randomElement($pacientes),
            'nombre_unidad' => $this->faker->text(200),
            'codigoTrabajador' => $this->faker->unique()->numberBetween(1000, 9999),
        ];
    }
}

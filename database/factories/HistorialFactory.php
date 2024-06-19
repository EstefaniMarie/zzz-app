<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Historial;
use App\Models\Empleados;
use App\Models\OtrosAsegurados;

class HistorialFactory extends Factory
{
    protected $model = Historial::class;

    public function definition()
    {
        $empleado = Empleados::pluck('id')->all();
        $asegurados = OtrosAsegurados::pluck('id')->all();
        return [
            'idEmpleado' => $this->faker->randomElement($empleado),
            'idOtroAsegurado' => $this->faker->randomElement($asegurados),
        ];
    }
}
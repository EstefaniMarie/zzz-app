<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OtrosAsegurados;
use App\Models\Empleados;

class OtrosAseguradosFactory extends Factory
{
    protected $model = OtrosAsegurados::class;

    public function definition()
    {
        $pacientes = Empleados::pluck('idEmpleados')->all();
        return [
            'Personas_idPersonas' => $this->faker->randomElement($pacientes),
        ];
    }
}
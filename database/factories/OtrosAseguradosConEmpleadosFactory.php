<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OtrosAseguradosConEmpleados;
use App\Models\Empleados;
use App\Models\Parentesco;
use App\Models\OtrosAsegurados;

class OtrosAseguradosConEmpleadosFactory extends Factory
{
    protected $model = OtrosAseguradosConEmpleados::class;

    public function definition()
    {
        $otrosAsegurados = OtrosAsegurados::pluck('id')->all();
        $empleados = Empleados::pluck('id')->all();
        $parentesco = Parentesco::pluck('id')->all();
        return [
            'idOtrosAsegurado' => $this->faker->randomElement($otrosAsegurados),
            'idEmpleado' => $this->faker->randomElement($empleados),
            'idParentesco' => $this->faker->randomElement($parentesco),
        ];
    }
}
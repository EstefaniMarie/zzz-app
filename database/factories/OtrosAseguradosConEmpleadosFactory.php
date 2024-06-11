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
        $otrosAsegurados = OtrosAsegurados::pluck('idOtros_Asegurados')->all();
        $empleados = Empleados::pluck('idEmpleados')->all();
        $parentesco = Parentesco::pluck('idParentesco')->all();
        return [
            'Otros_Asegurados_idOtros_Asegurados' => $this->faker->randomElement($otrosAsegurados),
            'Empleados_idEmpleados' => $this->faker->randomElement($empleados),
            'Parentesco_idParentesco' => $this->faker->randomElement($parentesco),
        ];
    }
}
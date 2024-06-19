<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Personas;
use App\Models\Parentesco;
use App\Models\Empleados;

class EmpleadosFactory extends Factory
{
    protected $model = Empleados::class;

    public function definition()
    {
        $persona = Personas::pluck('id')->all();
        $parentesco = Parentesco::pluck('id')->all();
        return [
            'idPersona' => $this->faker->unique()->randomElement($persona),
            'nombre_unidad' => $this->faker->text(200),
            'codigoTrabajador' => $this->faker->unique()->numberBetween(1000, 9999),
            'idParentesco' => $this->faker->randomElement($parentesco)
        ];
    }
}
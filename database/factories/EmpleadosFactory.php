<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Personas;
use App\Models\Empleados;

class EmpleadosFactory extends Factory
{
    protected $model = Empleados::class;

    public function definition()
    {
        $persona = Personas::pluck('idPersonas')->all();
        return [
            'Personas_idPersonas' => $this->faker->unique()->randomElement($persona),
            'nombre_unidad' => $this->faker->text(200),
        ];
    }
}
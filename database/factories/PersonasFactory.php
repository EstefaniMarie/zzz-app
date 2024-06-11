<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Personas;
use App\Models\Genero;

class PersonasFactory extends Factory
{
    protected $model = Personas::class;

    public function definition()
    {
        $genero = Genero::pluck('idGenero')->all();
        return [
            'nombres' => $this->faker->firstName,
            'apellidos'  => $this->faker->lastName,
            'fecha_nacimiento' => $this->faker->date('Y-m-d'),
            'codtra' => $this->faker->unique()->numberBetween(100000, 35000000),
            'cedula' => $this->faker->unique()->numberBetween(100000, 35000000),
            'numero_telefono' => $this->faker->optional()->numerify('04#########'),
            'Genero_idGenero' => $this->faker->randomElement($genero),
        ];
    }
}
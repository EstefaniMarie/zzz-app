<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Personas;
use Illuminate\Support\Str;
use App\Models\Genero;

class PersonasFactory extends Factory
{
    protected $model = Personas::class;

    public function definition()
    {
        $imagenMasculina = 'hombre.png';
        $imagenFemenina = 'mujer.png';

        $genero = $this->faker->randomElement([1, 2]);

        $imagen = $genero == 1 ? $imagenMasculina : $imagenFemenina;

        return [
            'image' => $imagen,
            'nombres' => $this->faker->firstName,
            'apellidos' => $this->faker->lastName,
            'fecha_nacimiento' => $this->faker->date('Y-m-d'),
            'cedula' => $this->faker->unique()->numberBetween(1000000, 99999999),
            'numero_telefono' => $this->faker->optional()->numerify('04#########'),
            'idGenero' => $genero,
        ];
    }
}

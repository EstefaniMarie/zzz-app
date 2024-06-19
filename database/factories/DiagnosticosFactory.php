<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Diagnosticos;

class DiagnosticosFactory extends Factory
{
    protected $model = Diagnosticos::class;

    public function definition()
    {
        return [
            'codigoDiagnostico' => $this->faker->unique()->numberBetween(0, 500),
            'descripcion' => $this->faker->text(1000),
        ];
    }
}
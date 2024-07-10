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
            'tipo' => $this->faker->text(50),
            'descripcion' => $this->faker->text(1000),
        ];
    }
}

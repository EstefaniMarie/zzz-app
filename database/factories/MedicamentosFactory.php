<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Medicamentos;

class MedicamentosFactory extends Factory
{
    protected $model = Medicamentos::class;

    public function definition()
    {
        return [
            'nombreMedicamento' => $this->faker->text(30),
            'presentacion' => $this->faker->text(10),
            'disponible' => $this->faker->numberBetween(1, 3000)
        ];
    }
}
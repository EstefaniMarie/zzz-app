<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MedicamentosConCitas;
use App\Models\Citas;
use App\Models\Medicamentos;
use App\Models\Farmaceutico;

class MedicamentosConCitasFactory extends Factory
{
    protected $model = MedicamentosConCitas::class;

    public function definition()
    {
        $citas = Citas::pluck('id')->all();
        $registro = Medicamentos::pluck('id')->all();
        $farmaceutico = Farmaceutico::pluck('id')->all();
        return [
            'idCita' => $this->faker->randomElement($citas),
            'idMedicamento' => $this->faker->randomElement($registro),
            'idFarmaceutico' => $this->faker->randomElement($farmaceutico),
        ];
    }
}
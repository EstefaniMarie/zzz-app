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
        $citas = Citas::pluck('idCitas')->all();
        $registro = Medicamentos::pluck('idRegistro_Medicamentos')->all();
        $farmaceutico = Farmaceutico::pluck('idFarmaceutico')->all();
        return [
            'Citas_idCitas' => $this->faker->randomElement($citas),
            'idRegistro_Medicamentos' => $this->faker->randomElement($registro),
            'Farmaceutico_idFarmaceutico' => $this->faker->randomElement($farmaceutico),
        ];
    }
}
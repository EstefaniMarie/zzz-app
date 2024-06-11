<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tratamientos;
use App\Models\Diagnosticos;

class TratamientosFactory extends Factory
{
    protected $model = Tratamientos::class;

    public function definition()
    {
        $diagnosticos = Diagnosticos::all(); 
        $diagnostico = $this->faker->randomElement($diagnosticos);
        $sintomasId = $diagnostico->Sintomas_idSintomas;
        $citasId = $diagnostico->Sintomas_Citas_idCitas;
        return [
            'Diagnosticos_idDiagnosticos' => $diagnostico->idDiagnosticos,
            'Diagnosticos_Sintomas_idSintomas' => $sintomasId,
            'Diagnosticos_Sintomas_Citas_idCitas' => $citasId,
            'descripcion' => $this->faker->text(2500),
        ];
    }
}
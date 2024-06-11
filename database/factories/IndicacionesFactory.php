<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Indicaciones;
use App\Models\Tratamientos;

class IndicacionesFactory extends Factory
{
    protected $model = Indicaciones::class;

    public function definition()
    {
        $indicaciones = Tratamientos::all(); 
        $indicacion = $this->faker->randomElement($indicaciones);
        $idDiagnosticos = $indicacion->Diagnosticos_idDiagnosticos;
        $idSintomas = $indicacion->Diagnosticos_Sintomas_idSintomas;
        $idCitas = $indicacion->Diagnosticos_Sintomas_Citas_idCitas;
        return [
            'Tratamientos_idTratamientos' => $indicacion->idTratamientos,
            'Tratamientos_Diagnosticos_idDiagnosticos' => $idDiagnosticos,
            'Tratamientos_Diagnosticos_Sintomas_idSintomas' => $idSintomas,
            'Tratamientos_Diagnosticos_Sintomas_Citas_idCitas' => $idCitas,
            'descripcion' => $this->faker->text(2500),
        ];
    }
}
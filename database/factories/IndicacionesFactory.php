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
        $idDiagnosticos = $indicacion->id;
        $idSintomas = $indicacion->id;
        $idCitas = $indicacion->id;
        return [
            'idTratamiento' => $indicacion->id,
            'idDiagnostico' => $idDiagnosticos,
            'idSintoma' => $idSintomas,
            'idCita' => $idCitas,
            'descripcion' => $this->faker->text(1000),
        ];
    }
}
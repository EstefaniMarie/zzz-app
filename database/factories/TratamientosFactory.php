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
        $sintomasId = $diagnostico->id;
        $citasId = $diagnostico->id;
        return [
            'idDiagnostico' => $diagnostico->id,
            'idSintoma' => $sintomasId,
            'idCita' => $citasId,
            'descripcion' => $this->faker->text(1000),
        ];
    }
}
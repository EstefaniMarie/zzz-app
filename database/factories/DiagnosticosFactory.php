<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Diagnosticos;
use App\Models\Sintomas;

class DiagnosticosFactory extends Factory
{
    protected $model = Diagnosticos::class;

    public function definition()
    {
        $sintomas = Sintomas::all(); 
        $sintoma = $this->faker->randomElement($sintomas);
        $citaId = $sintoma->id;
        return [
            'idSintoma' => $sintoma->id,
            'idCita' => $citaId,
            'descripcion' => $this->faker->text(1000),
        ];
    }
}
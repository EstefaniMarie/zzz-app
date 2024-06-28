<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Personales;
use App\Models\Familiares;
use App\Models\Personas;
use App\Models\Historial;

class PersonalesFactory extends Factory
{
    protected $model = Personales::class;

    public function definition()
    {
        $historial = Historial::pluck('id')->all();
        $antecedentesFamiliares = Familiares::pluck('id')->all();
        $idsEncontrados = Historial::select('idEmpleado', 'idOtroAsegurado')
            ->get()
            ->flatMap(function ($item) {
                return [$item->idEmpleado, $item->idOtroAsegurado];
            });



        // Paso 2: Usar pluck para extraer los IDs de las personas
        $personas = Personas::whereIn('id', $idsEncontrados)->pluck('id');
        return [
            'idHistorialClinico' => $this->faker->randomElement($historial),
            'idPersona' => $this->faker->randomElement($personas),
            'idAntecedenteFamiliar' => $this->faker->randomElement($antecedentesFamiliares),
            'tipo' => $this->faker->text(100),
            'descripcion' => $this->faker->text(100)
        ];
    }
}
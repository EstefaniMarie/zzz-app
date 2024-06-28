<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Historial;
use App\Models\Empleados;
use App\Models\Personas;

class HistoriaController extends Controller
{
    public function index() {
        $historiales = Historial::with([
            'empleados.personas.antecedentesFamiliares.antecedentesPersonales',
            'otrosAsegurados.personas.antecedentesFamiliares.antecedentesPersonales'
        ])->get();
        // dump($historiales[5]->empleados->personas->antecedentesPersonales);
        return view('historiasClinicas.index', 
        [
            'historiales' => $historiales,
        ]);
    }
}

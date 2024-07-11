<?php

namespace App\Http\Controllers;

use App\Models\Personas;

class TratamientosController extends Controller
{
    public function index()
    {
        $pacientes = Personas::with(['paciente.citas.consultas.diagnosticos.tratamientos'])->get();
        return view('tratamientos.index', compact('pacientes'));
    }
}

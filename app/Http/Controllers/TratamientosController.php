<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use App\Models\Diagnosticos;

class TratamientosController extends Controller
{
    public function index()
    {
        $pacientes = Personas::whereHas('diagnostico')->with('diagnostico')->distinct()->get();
        dd($pacientes);
        return view('tratamientos.index', compact('pacientes'));
    }

    public function detalles($id)
    {
        $diagnostico = Diagnosticos::with(['consultas.cita.paciente'])->findOrFail($id);
        $tratamientos = $diagnostico->tratamientos()->paginate(3);
        return view('tratamientos.detalles', compact('diagnostico', 'tratamientos'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use App\Models\Diagnosticos;

class TratamientosController extends Controller
{
    public function index()
    {
        $pacientes = Personas::whereHas('diagnosticos')->with('diagnosticos')->distinct()->get();
        return view('tratamientos.index', compact('pacientes'));
    }

    public function detalles($id)
    {
        $diagnostico = Diagnosticos::findOrFail($id);
        $tratamientos = $diagnostico->tratamientos()->paginate(3);
        return view('tratamientos.detalles', compact('diagnostico', 'tratamientos'));
    }
}

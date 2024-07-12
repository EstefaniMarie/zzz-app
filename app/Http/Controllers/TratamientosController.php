<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use App\Models\Tratamientos;
use App\Models\Diagnosticos;
use Illuminate\Support\Facades\DB;

class TratamientosController extends Controller
{
    public function index()
    {
        $pacientes = Personas::whereHas('citas.consultas.diagnosticos')->distinct()->get();
        return view('tratamientos.index', compact('pacientes'));
    }

    public function detalles($cedula)
    {
        $persona = Personas::where('cedula', $cedula)->with(['citas.consultas.diagnosticos.tratamientos'])->first();
        return view('tratamientos.detalles', compact('persona'));
    }
}

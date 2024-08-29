<?php

namespace App\Http\Controllers;

use App\Models\Personas;

class SintomasController extends Controller
{
    public function index()
    {
        $pacientes = Personas::whereHas('citas.consulta')->distinct()->get();
        return view('sintomas.index', compact('pacientes'));
    }

    public function detalles($cedula)
    {
        $persona = Personas::where('cedula', $cedula)->firstOrFail();
        return view('sintomas.detalles', compact('persona'));
    }
}
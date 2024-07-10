<?php

namespace App\Http\Controllers;

use App\Models\Diagnosticos;

class DiagnosticosController extends Controller
{
    public function index()
    {
        $diagnosticos = Diagnosticos::with('consultas.cita.paciente')->get();
        return view('diagnosticos.index', compact('diagnosticos'));
    }
}
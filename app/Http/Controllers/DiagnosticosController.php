<?php

namespace App\Http\Controllers;

use App\Models\Diagnosticos;
use App\Models\Consultas;
use Illuminate\Http\Request;

class DiagnosticosController extends Controller
{
    public function index()
    {
        $diagnosticos = Diagnosticos::with('consultas.cita.paciente')->get();
        return view('diagnosticos.index', compact('diagnosticos'));
    }

    public function detalles($id)
    {
        $consulta = Consultas::findOrFail($id);
        $diagnosticos = Diagnosticos::with('consultas.cita.paciente')->paginate(3);
        return view('diagnosticos.detalles', compact('consulta', 'diagnosticos'));
    }
}

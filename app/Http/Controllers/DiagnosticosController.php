<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use App\Models\Consultas;
use App\Models\Diagnosticos;
use App\Models\ConsultaConDiagnosticos;
use Illuminate\Http\Request;

class DiagnosticosController extends Controller
{
    public function index()
    {
        $pacientes = Personas::whereHas('consultas')->with('consultas')->distinct()->get();
        return view('diagnosticos.index', compact('pacientes'));
    }

    public function detalles($id)
    {
        $consulta = Consultas::with('diagnosticos')->findOrFail($id);
        $diagnosticos = $consulta->diagnosticos()->paginate(3);
        return view('diagnosticos.detalles', compact('consulta', 'diagnosticos'));
    }

    public function getDiagnosticos()
    {
        $diagnosticos = Diagnosticos::all();
        return response()->json($diagnosticos);
    }

    public function crear(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:2500',
            'idConsulta' => 'required|exists:consultas,id',
        ]);
        $diagnosticosIds = [];
        if ($request->has('diagnosticos_select') && is_array($request->diagnosticos_select)) {
            foreach ($request->diagnosticos_select as $diagnosticoId) {
                // Validar que el ID de diagnóstico sea válido
                if (is_numeric($diagnosticoId) && Diagnosticos::where('id', $diagnosticoId)->exists()) {
                    $diagnosticosIds[] = $diagnosticoId;
                }
            }
        }
        if ($request->has('diagnostico_input') && !empty($request->diagnostico_input)) {
            $diagnostico = Diagnosticos::create([
                'tipo' => $request->diagnostico_input,
                'descripcion' => $request->descripcion,
            ]);
            $diagnosticosIds[] = $diagnostico->id;
        }
        foreach ($diagnosticosIds as $diagnosticoId) {
            ConsultaConDiagnosticos::create([
                'idConsulta' => $request->idConsulta,
                'idDiagnostico' => $diagnosticoId,
            ]);
        }
        return redirect()->back()->with('success', 'Registros creados exitosamente.');
    }
}

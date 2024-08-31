<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use App\Models\Diagnosticos;
use App\Models\SintomaConDiagnostico;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class DiagnosticosController extends Controller
{
    public function index()
    {
        $pacientes = Personas::whereHas('citas.consulta.sintomas')->distinct()->get();
        return view('diagnosticos.index', compact('pacientes'));
    }

    public function detalles($cedula)
    {
        $persona = Personas::where('cedula', $cedula)->firstOrFail();
        $citas = $persona->citas()->has('consulta')->with('consulta.sintomas')->get();
        $diagnosticos = [];
        $sintomas = null;

        foreach ($citas as $cita) {
            $consulta = $cita->consulta;
            if ($consulta) {
                foreach ($consulta->sintomas as $sintoma) {
                    foreach ($sintoma->diagnosticos as $diagnostico) {
                        $diagnosticos[] = $diagnostico;
                    }
                }
            }
        }

        $page = request()->get('page', 1);
        $perPage = 3;
        $diagnosticosCollection = collect($diagnosticos);
        $data = $this->paginate($diagnosticosCollection, $perPage, $page);
        return view('diagnosticos.detalles', compact('persona', 'consulta', 'sintoma', 'data'));
    }

    protected function paginate($items, $perPage, $page)
    {
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(
            $items->slice($offset, $perPage),
            $items->count(),
            $perPage,
            $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
    }

    public function getDiagnosticos()
    {
        $diagnosticos = Diagnosticos::all();
        return response()->json($diagnosticos);
    }

    public function crear(Request $request)
    {
        $request->validate([
            'descripcion' => 'nullable|string|max:400',
            'idSintoma' => 'required|exists:sintomas,id',
        ]);
        $diagnosticosIds = [];
        if ($request->has('diagnosticos_select') && is_array($request->diagnosticos_select)) {
            foreach ($request->diagnosticos_select as $diagnosticoId) {
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
            SintomaConDiagnostico::create([
                'idSintoma' => $request->idSintoma,
                'idDiagnostico' => $diagnosticoId,
            ]);
        }
        return redirect()->back()->with('success', 'Registros creados exitosamente.');
    }
}

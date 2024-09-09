<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use App\Models\Tratamientos;
use App\Models\DiagnosticosConTratamientos;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TratamientosController extends Controller
{
    public function index()
    {
        $pacientes = Personas::whereHas('citas.consulta.sintomas.diagnosticos')->distinct()->get();
        return view('tratamientos.index', compact('pacientes'));
    }

    public function detalles($cedula)
    {
        $persona = Personas::where('cedula', $cedula)->firstOrFail();
        $diagnosticosxPaciente = $persona->citas()->has('consulta')->with('consulta.sintomas.diagnosticos')->get();
        $citas = $persona->citas()->has('consulta')->with('consulta.sintomas.diagnosticos.tratamientos')->get();
        $tratamientos = [];
        $diagnosticos = [];

        // DIAGNOSTICOS DEL PACIENTE EN LA BASE DE DATOS
        foreach ($diagnosticosxPaciente as $cita) {
            $consulta = $cita->consulta;
            if ($consulta) {
                foreach ($consulta->sintomas as $sintoma) {
                    foreach ($sintoma->diagnosticos as $diagnostico) {
                        $diagnosticos[] = $diagnostico;
                    }
                }
            }
        }

        // OBTENER LOS TRATAMIENTOS DE LA PERSONA
        foreach ($citas as $cita) {
            $consulta = $cita->consulta;
            if ($consulta) {
                foreach ($consulta->sintomas as $sintoma) {
                    foreach ($sintoma->diagnosticos as $diagnostico) {
                        if ($diagnostico) {
                            foreach ($diagnostico->tratamientos as $tratamiento) {
                                $tratamientos[] = $tratamiento;
                            }
                        }
                    }
                }
            }
        }

        $page = request()->get('page', 1);
        $perPage = 3;
        $diagnosticosCollection = collect($tratamientos);
        $data = $this->paginate($diagnosticosCollection, $perPage, $page);
        return view('tratamientos.detalles', compact('persona', 'data', 'diagnosticos'));
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


    public function getTratamientos()
    {
        $tratamientos = Tratamientos::all();
        return response()->json($tratamientos);
    }

    public function crear(Request $request)
    {
        $request->validate([
            'descripcion' => 'nullable|string|max:400',
            'diagnosticos_select' => 'required|array',
            'diagnosticos_select.*' => 'exists:diagnosticos,id',
        ]);
        $tratamientosIds = [];
        if ($request->has('tratamientos_select') && is_array($request->tratamientos_select)) {
            foreach ($request->tratamientos_select as $tratamientoId) {
                if (is_numeric($tratamientoId) && Tratamientos::where('id', $tratamientoId)->exists()) {
                    $tratamientosIds[] = $tratamientoId;
                }
            }
        }
        if ($request->has('tratamiento_input') && !empty($request->tratamiento_input)) {
            $tratamiento = Tratamientos::create([
                'tipo' => $request->tratamiento_input,
                'descripcion' => $request->descripcion,
            ]);
            $tratamientosIds[] = $tratamiento->id;
        }
        foreach ($request->diagnosticos_select as $diagnosticoId) {
            foreach ($tratamientosIds as $tratamientoId) {
                DiagnosticosConTratamientos::create([
                    'idDiagnostico' => $diagnosticoId,
                    'idTratamiento' => $tratamientoId,
                ]);
            }
        }
        return redirect()->back()->with('success', 'Registros creados exitosamente.');
    }
}

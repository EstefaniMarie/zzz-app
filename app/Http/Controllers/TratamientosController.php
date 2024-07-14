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
        $pacientes = Personas::whereHas('citas.consultas.diagnosticos')->distinct()->get();
        return view('tratamientos.index', compact('pacientes'));
    }

    public function detalles($cedula)
    {
        $persona = Personas::where('cedula', $cedula)->with(['citas.consultas.diagnosticos.tratamientos'])->first();

        // OBTENER LOS TRATAMIENTOS DE LA PERSONA
        $tratamientos = $persona->citas->flatMap(function ($cita) {
            return $cita->consultas->flatMap(function ($consulta) {
                return $consulta->diagnosticos->flatMap(function ($diagnostico) {
                    return $diagnostico->tratamientos;
                });
            });
        });

        // PAGINACION
        $paginaActual = LengthAwarePaginator::resolveCurrentPage();
        $porPagina = 3;
        $currentItems = $tratamientos->slice(($paginaActual - 1) * $porPagina, $porPagina)->all();
        $paginacionTratamientos = new LengthAwarePaginator($currentItems, $tratamientos->count(), $porPagina, $paginaActual, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        // OBTENER DIAGNOSTICOS POR EL PACIENTE
        $diagnosticos = $persona->citas->flatMap(function ($cita) {
            return $cita->consultas->flatMap(function ($consulta) {
                return $consulta->diagnosticos;
            });
        });

        return view('tratamientos.detalles', compact('persona', 'paginacionTratamientos', 'diagnosticos'));
    }

    public function getTratamientos()
    {
        $tratamientos = Tratamientos::all();
        return response()->json($tratamientos);
    }

    public function crear(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:2500',
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
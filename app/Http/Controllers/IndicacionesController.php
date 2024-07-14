<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use App\Models\Indicaciones;
use App\Models\Recipes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class IndicacionesController extends Controller
{
    public function index()
    {
        $pacientes = Personas::whereHas('citas.consultas.diagnosticos.tratamientos')->distinct()->get();
        return view('indicaciones.index', compact('pacientes'));
    }

    public function detalles($cedula)
    {

        $persona = Personas::where('cedula', $cedula)->firstOrFail();

        // Obtener las indicaciones de la persona
        $indicaciones = $persona->citas->flatMap(function ($cita) {
            return $cita->consultas->flatMap(function ($consulta) {
                return $consulta->diagnosticos->flatMap(function ($diagnostico) {
                    return $diagnostico->tratamientos->flatMap(function ($tratamiento) {
                        return $tratamiento->indicaciones;
                    });
                });
            });
        });
    
        // PAGINACION
        $paginaActual = LengthAwarePaginator::resolveCurrentPage();
        $porPagina = 3;
        $currentItems = $indicaciones->slice(($paginaActual - 1) * $porPagina, $porPagina)->all();
        $paginacionIndicaciones = new LengthAwarePaginator($currentItems, $indicaciones->count(), $porPagina, $paginaActual, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        // OBTENER TRATAMIENTOS POR EL PACIENTE
        $tratamientos = $persona->citas->flatMap(function ($cita) {
            return $cita->consultas->flatMap(function ($consulta) {
                return $consulta->diagnosticos->flatMap(function ($diagnostico) {
                    return $diagnostico->tratamientos;
                });
            });
        });

        return view('indicaciones.detalles', compact('persona', 'paginacionIndicaciones', 'tratamientos'));
    }

    public function getIndicaciones()
    {
        $indicaciones = Indicaciones::all();
        return response()->json($indicaciones);
    }

    public function crear(Request $request)
    {
        $rules = [
            'descripcion' => 'required|string|max:400',
            'tratamientos_select' => 'required|array',
            'tratamientos_select.*' => 'exists:tratamientos,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->after(function ($validator) use ($request) {
            if (empty($request->indicaciones_select) && empty($request->indicacion_input)) {
                $validator->errors()->add('indicaciones', 'Debe seleccionar al menos una indicación o ingresar una nueva.');
            }
        });
        $validator->validate();
        $indicacionesIds = [];
        if ($request->has('indicaciones_select') && is_array($request->indicaciones_select)) {
            foreach ($request->indicaciones_select as $indicacionId) {
                if (is_numeric($indicacionId) && Indicaciones::where('id', $indicacionId)->exists()) {
                    $indicacionesIds[] = $indicacionId;
                }
            }
        }
        if ($request->has('indicacion_input') && !empty($request->indicacion_input)) {
            $indicacion = Indicaciones::create([
                'tipo' => $request->indicacion_input,
                'descripcion' => $request->descripcion,
            ]);
            $indicacionesIds[] = $indicacion->id;
        }
        foreach ($request->tratamientos_select as $tratamientoId) {
            foreach ($indicacionesIds as $indicacionId) {
                Recipes::create([
                    'idTratamiento' => $tratamientoId,
                    'idIndicacion' => $indicacionId,
                ]);
            }
        }
        return redirect()->back()->with('success', 'Registros creados exitosamente.');
    }
}
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
        $pacientes = Personas::whereHas('citas.consulta.sintomas.diagnosticos.tratamientos')->distinct()->get();
        return view('indicaciones.index', compact('pacientes'));
    }

    public function detalles($cedula)
    {

        $paciente = Personas::where('cedula', $cedula)->firstOrFail();
        $tratamientosxPaciente = $paciente->citas()->has('consulta')->with('consulta.sintomas.diagnosticos.tratamientos')->get();
        $citas = $paciente->citas()->has('consulta')->with('consulta.sintomas.diagnosticos.tratamientos.indicaciones')->get();
        $indicaciones = [];
        $tratamientos = [];


        // TRATAMIENTOS DEL PACIENTE EN LA BASE DE DATOS
        foreach ($tratamientosxPaciente as $cita) {
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

        // INDICACIONES DEL PACIENTE
        foreach ($citas as $cita) {
            $consulta = $cita->consulta;
            if ($consulta) {
                foreach ($consulta->sintomas as $sintoma) {
                    foreach ($sintoma->diagnosticos as $diagnostico) {
                        if ($diagnostico) {
                            foreach ($diagnostico->tratamientos as $tratamiento) {
                                if ($tratamiento) {
                                    foreach ($tratamiento->indicaciones as $indicacion) {
                                        $indicaciones[] = $indicacion;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $page = request()->get('page', 1);
        $perPage = 3;
        $indicacionesCollection = collect($indicaciones);
        $data = $this->paginate($indicacionesCollection, $perPage, $page);
        return view('indicaciones.detalles', compact('paciente', 'data', 'tratamientos'));
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

    public function getIndicaciones()
    {
        $indicaciones = Indicaciones::all();
        return response()->json($indicaciones);
    }

    public function crear(Request $request)
    {
        $rules = [
            'descripcion' => 'nullable|string|max:400',
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

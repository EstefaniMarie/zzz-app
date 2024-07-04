<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Familiares;
use App\Models\Personas;

class FamiliaresController extends Controller
{
    public function getAntecedentesFamiliaresJson($idPersona){
        $data = Familiares::select('id','tipo', 'descripcion')->get();
        return response()->json($data);
    }
    public function create(Request $request) {
        try {
            $familiar = Familiares::create([
                'tipo' => $request->tipo,
                'descripcion' => $request->descripcion,
                'idPersona' => $request->idPersona,
                'idOtroAsegurado' => $request->idOtroAsegurado
            ]);

            $paciente = Personas::select('id','nombres','apellidos', 'cedula')->where('id', $request->idPersona)->get();
            return response()->json([
                'message' => 'Antecedente creado exitosamente.',
                'datosPersona' => $paciente[0]
            ], 201);
        } catch (\Throwable $th) {

            return response()->json(['message' => 'Error al crear antecedente.'], 500);
        }
    }

}

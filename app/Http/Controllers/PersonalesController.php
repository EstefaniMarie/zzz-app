<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Personales;
use App\Models\Personas;
class PersonalesController extends Controller
{
    public function create(Request $request) {
        try {
            $personal = Personales::create([
                'tipo' => $request->tipo,
                'descripcion' => $request->descripcion,
                'idPersona' => $request->idPersona,
                'idHistorialClinico' => $request->idHistorialClinico,
                'idAntecedenteFamiliar' => $request->idAntecedenteFamiliar
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

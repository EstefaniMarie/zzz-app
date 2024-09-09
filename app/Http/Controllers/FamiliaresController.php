<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Familiares;
use App\Models\Personas;
use App\Models\Pacientes;

class FamiliaresController extends Controller
{
    public function getAntecedentesFamiliaresJson($idPersona){
        $data = Familiares::select('id','tipo', 'descripcion')->get();
        return response()->json($data);
    }
    public function create(Request $request) {
        try {

            $request->validate([
                'tipo' => ['required', 'string', 'max:180', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/'],
                'descripcion' => ['required', 'string', 'max:255'],
                'idPersona' => 'required',
                'idOtroAsegurado' => 'required'
            ],[
                'tipo.required' => 'El campo "Tipo de Antecedente" no puede estar vacío',
                'tipo.regex' => 'El campo "Tipo de Antecedente" no admite números o carácteres especiales',
                'tipo.max' => 'El campo "Tipo de Antecedente" no puede superar los 180 caractéres',
                'descripcion.required' => 'El campo "Descripcion" no puede estar vacío',
                'descripcion.max' => 'El campo "Tipo de Antecedente" no puede superar los 255 caractéres',
            ]);

            $idPaciente = DB::table('pacientes')
                ->join('personas', 'personas.id', '=', 'pacientes.idPersona')
                ->select('idPersona')
                ->where('pacientes.idPersona', '=', $request->idPersona)
                ->get();
            
            $familiar = Familiares::create([
                'tipo' => $request->tipo,
                'descripcion' => $request->descripcion,
                'idPersona' => $idPaciente[0]->idPersona,
                'idOtroAsegurado' => $request->idOtroAsegurado
            ]);

            $paciente = Personas::select('id','nombres','apellidos', 'cedula')->where('id', $request->idPersona)->get();

            return response()->json([
                'message' => 'Antecedente creado exitosamente.',
                'datosPersona' => $paciente[0]
            ], 201);
        } catch (\Throwable $th) {

            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

}

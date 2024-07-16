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
            $request->validate([
                'tipo' => ['required', 'string', 'max:180', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/'],
                'descripcion' => ['required', 'string', 'max:255'],
                'idPersona' => 'required',
                'idAntecedenteFamiliar' => 'required'
            ],[
                'tipo.required' => 'El campo "Tipo de Antecedente" no puede estar vacío',
                'tipo.regex' => 'El campo "Tipo de Antecedente" no admite números o carácteres especiales',
                'tipo.max' => 'El campo "Tipo de Antecedente" no puede superar los 180 caractéres',
                'descripcion.required' => 'El campo "Descripcion" no puede estar vacío',
                'descripcion.max' => 'El campo "Tipo de Antecedente" no puede superar los 255 caractéres',
                'idPersona' => 'EL id Persona es requerido',
                'idAntecedenteFamiliar' => 'El id de Asegurado es requerido'
            ]);

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

            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\OtrosAsegurados;
use App\Models\OtrosAseguradosConEmpleados;
use App\Models\Pacientes;
use App\Models\Personas;
use Illuminate\Http\Request;

class OtrosAseguradosController extends Controller
{
    public function detallesOtrosAsegurados()
    {
        $otrosAsegurados = OtrosAsegurados::with('pacientes.personas')->get();
        return view('tablas.detallesOtrosAsegurados', compact('otrosAsegurados'));
    }

    public function updateStatusOtroAsegurado(Request $request, $id)
    {
        $otroAsegurado = OtrosAsegurados::find($id);
        if ($otroAsegurado) {
            $otroAsegurado->estatus = $request->input('estatus');
            $otroAsegurado->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function storeOtroAsegurado(Request $request)
    {
        $validatedData = $request->validate([
            'nombres' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'apellidos' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'cedula' => ['required', 'integer', 'min:1000000', 'max:99999999'],
            'fecha_nacimiento' => ['required', 'date'],
            'idGenero' => ['required', 'exists:genero,id'],
            'idParentesco' => ['required', 'exists:parentescos,id']
        ]);
        try {
            $persona = Personas::create([
                'nombres' => $validatedData['nombres'],
                'apellidos' => $validatedData['apellidos'],
                'cedula' => $validatedData['cedula'],
                'fecha_nacimiento' => $validatedData['fecha_nacimiento'],
                'idGenero' => $validatedData['idGenero'],
            ]);
            $paciente = Pacientes::create([
                'idPersona' => $persona->id
            ]);
            $otrosAsegurados = OtrosAsegurados::create([
                'idPacientes' => $paciente->id,
            ]);
            OtrosAseguradosConEmpleados::create([
                'idOtroAsegurado' => $otrosAsegurados->id,
                'idParentesco' => $validatedData['idParentesco'],
            ]);
            return redirect()->back()->with('success', 'Otro Asegurado creado exitosamente');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
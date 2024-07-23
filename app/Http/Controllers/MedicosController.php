<?php

namespace App\Http\Controllers;

use App\Models\MedicosConEspecialidades;
use App\Models\Medicos;
use App\Models\Personas;
use App\Models\User;
use Illuminate\Http\Request;

class MedicosController extends Controller
{
    public function detallesMedicos()
    {
        $medicos = Medicos::with('usuario.persona')->get();
        return view('tablas.detallesMedicos', compact('medicos'));
    }

    public function updateStatusMedico(Request $request, $id)
    {
        $medico = Medicos::find($id);
        if ($medico) {
            $medico->estatus = $request->input('estatus');
            $medico->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function storeMedicos(Request $request)
    {
        $validatedData = $request->validate([
            'nombres' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'apellidos' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'cedula' => ['required', 'integer', 'min:1000000', 'max:99999999'],
            'fecha_nacimiento' => ['required', 'date'],
            'email' => ['required', 'email'],
            'idGenero' => ['required', 'exists:genero,id'],
            'colegiatura' => ['required', 'string', 'max:15'],
            'idEspecialidad' => ['required', 'exists:especialidades,id'],
            'dias' => ['required', 'array'],
            'dias.*' => ['required', 'integer', 'between:1,5'],
            'horas' => ['required', 'array'],
            'horas.*' => ['required', 'integer', 'between:1,8'],
        ]);
        $validatedData['password'] = '12345678';
        $validatedData['idRol'] = 3;
        $diasDisponibles = implode(',', $validatedData['dias']);
        $horasDisponibles = implode(',', $validatedData['horas']);
        try {
            $persona = Personas::create([
                'nombres' => $validatedData['nombres'],
                'apellidos' => $validatedData['apellidos'],
                'cedula' => $validatedData['cedula'],
                'fecha_nacimiento' => $validatedData['fecha_nacimiento'],
                'idGenero' => $validatedData['idGenero'],
            ]);
            $usuario = User::create([
                'idPersona' => $persona->id,
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'idRol' => $validatedData['idRol'],
            ]);
            $medico = Medicos::create([
                'idUsuario' => $usuario->id,
                'colegiatura' => $validatedData['colegiatura'],
                'diasDisponibles' => $diasDisponibles,
                'horasDisponibles' => $horasDisponibles,
            ]);
            MedicosConEspecialidades::create([
                'idMedico' => $medico->id,
                'idEspecialidad' => $validatedData['idEspecialidad'],
            ]);
            return redirect()->back()->with('success', 'Médico creado exitosamente');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function getMedicos()
    {
        $medicos = Medicos::with('usuario.persona')->get();
        return response()->json($medicos);
    }
}

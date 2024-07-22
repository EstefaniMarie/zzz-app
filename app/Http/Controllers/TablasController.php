<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use App\Models\User;
use App\Models\Personas;
use App\Models\Pacientes;
use App\Models\Especialidades;
use App\Models\MedicosConEspecialidades;
use App\Models\Medicos;
use Illuminate\Http\Request;

class TablasController extends Controller
{
    public function index()
    {
        return view('tablas.index');
    }

    public function detallesEmpleados()
    {
        $empleados = Empleados::with('pacientes.personas')->get();
        return view('tablas.detallesEmpleados', compact('empleados'));
    }
    public function storeEmpleados(Request $request)
    {
        $validatedData = $request->validate([
            'nombres' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'apellidos' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'cedula' => ['required', 'integer', 'min:1000000', 'max:99999999'],
            'fecha_nacimiento' => ['required', 'date'],
            'codigoTrabajador' => ['required', 'integer', 'min:1', 'max:35000000'],
            'nombre_unidad' => ['required', 'string', 'max:250', 'regex:/^[a-zA-Z\s]+$/'],
            'idGenero' => ['required', 'exists:genero,id']
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
            Empleados::create([
                'idPacientes' => $paciente->id,
                'codigoTrabajador' => $validatedData['codigoTrabajador'],
                'nombre_unidad' => $validatedData['nombre_unidad'],
            ]);
            return redirect()->back()->with('success', 'Empleado creado exitosamente');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function updateStatusEmpleado(Request $request, $id)
    {
        $empleado = Empleados::find($id);
        if ($empleado) {
            $empleado->estatus = $request->input('estatus');
            $empleado->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

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
        ]);
        $validatedData['password'] = '12345678';
        $validatedData['idRol'] = 3;
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

    public function getEspecialidades()
    {
        $especialidades = Especialidades::all();
        return response()->json($especialidades);
    }
}

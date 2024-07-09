<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use Exception;
use Illuminate\Http\Request;

use App\Models\Pacientes;
use Illuminate\Support\Facades\DB;

class PacientesController extends Controller
{
    public function index()
    {
        $pacientes = Pacientes::with('personas')->get();
        // dump($pacientes[5]->empleados->personas->antecedentesPersonales);
        return view('historiasClinicas.index', 
        [
            'pacientes' => $pacientes,
        ]);
    }

    public function detallesClinicos($id){
        $antecedentesFamiliares = DB::table('antecedentesFamiliares')
            ->select('tipo', 'descripcion')
            ->where('idPersona', $id)
            ->get();

        $antecedentesPersonales = DB::table('antecedentesPersonales')
        ->select('tipo', 'descripcion')
        ->where('idPersona', $id)
        ->get();
        return response()->json([
            'antecedentesFamiliares' => $antecedentesFamiliares, 
            'antecedentesPersonales' => $antecedentesPersonales]);
    }

    public function createPaciente(Request $request){
        // dd(preg_match('/[^a-zA-Z]+$/', $request->nombres));
        try {
            $request->validate([
                'nombres' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
                'apellidos' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
                'cedula' => ['required', 'integer','min:1000000', 'max:99999999'],
            ],[
                'nombres.required' => 'El campo nombres es requerido',
                'nombres.regex' => 'El campo nombres no puede contener numeros o caracteres especiales',
                'apellidos.required' => 'El campo apellido es requerido',
                'apellidos.regex' => 'El campo apellido no puede contener numeros o caracteres especiales',
                'cedula.required' => 'El campo cédula es requerido',
                'cedula.regex' => 'El campo cédula solo puede contener números',
                'cedula.min' => 'El número de cedula no es valido (muy pequeno)',
                'cedula.max' => 'El número de cedula no es valido (muy grande)'
            ]);

            $persona = Personas::create($request->all());
            Pacientes::create([
                'idPersona' => $persona->id
            ]);
            return redirect()->route('historiasClinicas')->with('success','Paciente creado exitosamente: '.$request->cedula.' - '.$request->nombres.' '. $request->apellidos);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
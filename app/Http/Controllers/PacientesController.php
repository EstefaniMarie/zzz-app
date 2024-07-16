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
            $validatedData = $request->validate([
                'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
                'nombres' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
                'apellidos' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
                'cedula' => ['required', 'integer', 'min:1000000', 'max:99999999'],
                'fecha_nacimiento' => ['required', 'date'],
                'numero_telefono' => ['nullable', 'regex:/^04\d{9}$/'],
                'idGenero' => ['required', 'exists:genero,id'],
            ], [
                'image.image' => 'El archivo debe ser una imagen válida.',
                'image.mimes' => 'La imagen debe ser de tipo JPEG, PNG o JPG.',
                'image.max' => 'La imagen no debe superar los 2MB.',
                'nombres.required' => 'El campo nombres es requerido.',
                'nombres.regex' => 'El campo nombres no puede contener números o caracteres especiales.',
                'apellidos.required' => 'El campo apellidos es requerido.',
                'apellidos.regex' => 'El campo apellidos no puede contener números o caracteres especiales.',
                'cedula.required' => 'El campo cédula es requerido.',
                'cedula.integer' => 'El campo cédula debe ser un número entero.',
                'cedula.min' => 'El número de cédula no es válido (demasiado pequeño).',
                'cedula.max' => 'El número de cédula no es válido (demasiado grande).',
                'fecha_nacimiento.required' => 'El campo fecha de nacimiento es requerido.',
                'fecha_nacimiento.date' => 'El campo fecha de nacimiento debe ser una fecha válida.',
                'numero_telefono.regex' => 'El campo número de teléfono debe ser válido y comenzar con 04.',
                'idGenero.required' => 'El campo género es requerido.',
                'idGenero.exists' => 'El género seleccionado no es válido.',
            ]);

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('images'), $imageName);
                $validatedData['image'] = $imageName;
            }
            $persona = Personas::create($validatedData);
            Pacientes::create([
                'idPersona' => $persona->id
            ]);
            return redirect()->route('historiasClinicas')->with('success','Paciente creado exitosamente: '.$request->cedula.' - '.$request->nombres.' '. $request->apellidos);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

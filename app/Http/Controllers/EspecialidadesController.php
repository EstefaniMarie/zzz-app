<?php

namespace App\Http\Controllers;

use App\Models\Especialidades;
use App\Models\MedicosConEspecialidades;
use Illuminate\Http\Request;

class EspecialidadesController extends Controller
{
    public function getEspecialidades()
    {
        $especialidades = Especialidades::all();
        return response()->json($especialidades);
    }

    public function detallesEspecialidades()
    {
        $especialidades = Especialidades::all();
        return view('tablas.detallesEspecialidades', compact ('especialidades'));
    }

    public function updateStatusEspecialidades(Request $request, $id)
    {
        $especialidades = Especialidades::find($id);
        if ($especialidades) {
            $especialidades->estatus = $request->input('estatus');
            $especialidades->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function storeEspecialidades(Request $request)
    {
        $validatedData = $request->validate([
            'especialidad_principal' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z\s]+$/'],
            'especialidad_adicional' => ['nullable', 'string', 'max:100', 'regex:/^[a-zA-Z\s]+$/'],
            'idMedico' => ['required', 'exists:medicos,id'],
        ]);

        $idMedico = $validatedData['idMedico'];
    
        $especialidadPrincipal = Especialidades::create([
            'descripcion' => $validatedData['especialidad_principal'],
            'medico_id' => $idMedico,
        ]);
        MedicosConEspecialidades::create([
            'idEspecialidad' => $especialidadPrincipal->id,
            'idMedico' => $idMedico
        ]);

        if (!empty($validatedData['especialidad_adicional'])) {
            $especialidadAdicional = Especialidades::create([
                'descripcion' => $validatedData['especialidad_adicional'],
                'medico_id' => $idMedico,
            ]);
            MedicosConEspecialidades::create([
                'idEspecialidad' => $especialidadAdicional->id,
                'idMedico' => $idMedico
            ]);
        }

        return redirect()->back()->with('success', 'Especialidades registradas correctamente.');
    }
}
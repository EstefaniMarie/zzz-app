<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Historial;
use App\Models\Empleados;
use App\Models\Personas;

class HistoriaController extends Controller
{
    public function index() {
        $historiales = Historial::with([
            'empleados.personas',
            'otrosAsegurados.personas'
        ])->get();
        // dump($historiales[5]->empleados->personas->antecedentesPersonales);
        return view('historiasClinicas.index', 
        [
            'historiales' => $historiales,
        ]);
    }

    public function detallesClinicos($id){
        $antecedentesPersonales =  DB::table('personas')
        ->join('antecedentesPersonales', 'antecedentesPersonales.idPersona','=','personas.id')
        ->join('antecedentesFamiliares', 'antecedentesPersonales.idPersona','=','personas.id')
        ->select('nombres', 'apellidos','cedula','antecedentesPersonales.descripcion as personalDescripcion', 'antecedentesFamiliares.descripcion as familiarDescripcion')
        ->where('personas.id','=', $id)
        ->get();
        // $antecedentesFamiliares = Personas::find($id)->with('antecedentesFamiliares');
        // dump($antecedentesPersonales)
        return response()->json($antecedentesPersonales);
    }
}

<?php

namespace App\Http\Controllers;

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
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Historial;

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

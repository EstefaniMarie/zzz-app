<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use Illuminate\Http\Request;

class AseguradoController extends Controller
{
    public function getAseguradosJson($campos = null) //Devuelve los nombres, apellidos y cedulas de los asegurados
    {
    
        try {
            $query = Personas::query();
    
            if ($campos !== null) {
                // Comprueba si $campos es un array
                if (is_array($campos)) {
                    // Si es un array, conviértelo en una cadena separada por comas
                    $campos = implode(',', $campos);
                } else {
                    // Si no es un array, trata $campos como un solo campo
                    $campos = "{$campos}";
                }
    
                $query
                    ->join('pacientes', 'pacientes.idPersona', '=', 'personas.id')
                    ->join('otrosAsegurados', 'otrosAsegurado.idPacientes', '=', 'pacientes.id')
                    ->select($campos);
            }
    
            $query
                ->join('pacientes', 'pacientes.idPersona', '=', 'personas.id')
                ->join('otrosAsegurados as oa', 'oa.idPacientes', '=', 'pacientes.id')
                ->select('personas.id','personas.nombres', 'personas.apellidos', 'personas.cedula', 'oa.id as idOtroAsegurado');
            $asegurados = $query->get();
    
            // Devolvemos los asegurados
            return response()->json($asegurados);
        
        } catch (\ErrorException $e) {
            return response()->json(['error'=> $e->getMessage()]);
        }
    }
}

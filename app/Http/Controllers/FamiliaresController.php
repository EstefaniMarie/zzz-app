<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Familiares;
use App\Models\Personas;

class FamiliaresController extends Controller
{
    public function getAntecedentesFamiliaresJson($idPersona){
        $data = Familiares::select('id','tipo', 'descripcion')->get();
        return response()->json($data);
    }
    public function create(Request $request){
        try {
            Familiares::create([
                'tipo' => $request->tipo,
                'descripcion' => $request->descripcion,
                'idPersona' => $request->idPersona,
                'idOtroAsegurado' => $request->idOtroAsegurado
            ]);

            return response()
                ->json(Personas::select('id', 'nombres', 'apellidos', 'cedula')->where('id', $request->idPersona))
                ->setStatusCode(200);
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }
}

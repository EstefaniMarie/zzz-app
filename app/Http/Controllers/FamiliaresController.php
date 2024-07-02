<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Familiares;

class FamiliaresController extends Controller
{
    public function getAntecedentesFamiliaresJson($idPersona){
        $data = Familiares::select('tipo', 'descripcion')->get();
        return response()->json($data);
    }
    public function añadirAntecedente(Request $request){
        
    }
}

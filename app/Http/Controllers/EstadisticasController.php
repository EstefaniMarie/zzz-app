<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Consultas;

class EstadisticasController extends Controller
{
    public function index()
    {
        $data = DB::table('genero')
            ->join('personas', 'genero.id', '=', 'personas.idGenero')
            ->join('pacientes', 'personas.id', '=', 'pacientes.idPersona')
            ->select('genero.descripcion AS genero', DB::raw('COUNT(pacientes.id) AS cantidad'))
            ->groupBy('genero.descripcion')
            ->get();

        $especialidades = DB::table('especialidades')
            ->join('medicos_has_especialidades', 'especialidades.id', '=', 'medicos_has_especialidades.idEspecialidad')
            ->join('medicos', 'medicos_has_especialidades.idMedico', '=', 'medicos.id')
            ->select('especialidades.descripcion AS especialidad', DB::raw('COUNT(medicos.id) AS cantidad_medicos'))
            ->groupBy('especialidades.descripcion')
            ->get();

        $citas = Consultas::selectRaw("
            MONTHNAME(start_date) AS Mes,
            COUNT(*) AS Cantidad_Citas
        ")
            ->whereYear('start_date', date('Y'))
            ->groupByRaw("MONTHNAME(start_date), YEAR(start_date)")
            ->orderByRaw("YEAR(start_date) DESC, MONTHNAME(start_date) DESC")
            ->get();

        $usuarios = DB::table('usuarios')
            ->selectRaw("
                SUM(CASE WHEN Status = 1 THEN 1 ELSE 0 END) AS usuarios_activos,
                SUM(CASE WHEN Status = 0 THEN 1 ELSE 0 END) AS usuarios_bloqueados
            ")
            ->first();

        return view('estadisticas.index', compact('data', 'especialidades', 'citas', 'usuarios'));
    }
}
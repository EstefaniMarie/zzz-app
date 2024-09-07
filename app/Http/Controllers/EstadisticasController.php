<?php

namespace App\Http\Controllers;

use App\Models\MedicosConConsultas;
use Illuminate\Support\Facades\DB;
use App\Models\Consultas;
use Request;

class EstadisticasController extends Controller
{
    public function index()
    {
        $medicos = DB::table('medicos')
        ->join('usuarios', 'medicos.idUsuario', '=', 'usuarios.id')
        ->join('personas', 'usuarios.idPersona', '=', 'personas.id')
        ->select(['personas.nombres as nombres','personas.apellidos as apellidos','personas.cedula as cedula'])
        ->distinct()
        ->get();
        
        // dd($medicos);
        return view('estadisticas.index', ['medicos' => $medicos]);
    }

    public function getConsultasMedico(Request $request) {
        
        $cedulaMedico = $request->input('cedulaMedico');

        $consultasMedico = DB::table('medicos')
            ->join('medicos_has_consultas', 'medicos.id', '=', 'medicos_has_consultas.idMedico')
            ->join('usuarios', 'medicos.idUsuario', '=', 'usuarios.id')
            ->join('personas', 'usuarios.idPersona', '=', 'personas.id')
            ->select([
                DB::raw('MONTH(medicos_has_consultas.created_at) as mes'),
                DB::raw('COUNT(*) as consultas_mes')
            ])
            ->where('personas.cedula', $cedulaMedico)
            ->groupBy(DB::raw('MONTH(medicos_has_consultas.created_at)'))
            ->orderBy(DB::raw('MONTH(medicos_has_consultas.created_at)'))
            ->get();

        $resultado = array();

        foreach ($consultasMedico as $consulta) {
            $mes = $this->getMesNombre($consulta->mes);
            $resultado[$mes] = $consulta->consultas_mes;
        }

        return response()->json($resultado);
    }

    private function getMesNombre($mesNumero)
    {
        $meses = array(
            '1' => 'Enero',
            '2' => 'Febrero',
            '3' => 'Marzo',
            '4' => 'Abril',
            '5' => 'Mayo',
            '6' => 'Junio',
            '7' => 'Julio',
            '8' => 'Agosto',
            '9' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre',
        );

        return $meses[$mesNumero];
    }

}
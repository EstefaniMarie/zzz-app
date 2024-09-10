<?php

namespace App\Http\Controllers;

use App\Models\MedicosConConsultas;
use Exception;
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

        $edades = DB::table('personas')
        ->join('pacientes', 'pacientes.idPersona', '=', 'personas.id')
        ->select(DB::raw('TIMESTAMPDIFF(YEAR, personas.fecha_nacimiento, CURRENT_DATE) AS edad'))
        ->orderBy(DB::raw('edad'))
        ->get();

        $pacienteEdad = $this->grupoEtario($edades);
        
        // dd($medicos);
        return view('estadisticas.index', [
            'medicos' => $medicos,
            'pacientesEdad' => json_encode($pacienteEdad)
        ]);
    }

    public function getConsultasMedico($cedulaMedico) {
        try {
    
            $consultasMedico = DB::table('medicos')
                ->join('medicos_has_consultas', 'medicos.id', '=', 'medicos_has_consultas.idMedico')
                ->join('usuarios', 'medicos.idUsuario', '=', 'usuarios.id')
                ->join('personas', 'usuarios.idPersona', '=', 'personas.id')
                ->select([
                    DB::raw('MONTH(medicos_has_consultas.created_at) as mes, COUNT(*) as consultas_mes'),
                ])
                ->where('personas.cedula', $cedulaMedico)
                ->groupBy(DB::raw('MONTH(medicos_has_consultas.created_at)'))
                ->orderBy(DB::raw('MONTH(medicos_has_consultas.created_at)'))
                ->get();
    
            $meses = [
                'Enero' => 0,
                'Febrero' => 0,
                'Marzo' => 0,
                'Abril' => 0,
                'Mayo' => 0,
                'Junio' => 0,
                'Julio' => 0,
                'Agosto' => 0,
                'Septiembre' => 0,
                'Octubre' => 0,
                'Noviembre' => 0,
                'Diciembre' => 0,
            ];
    
            foreach ($consultasMedico as $consulta) {
                $mes = $this->getMesNombre($consulta->mes);
                $meses[$mes] = $consulta->consultas_mes;
            }
    
            return response()->json($meses);
        } catch(Exception $e) {
            return response()->json(['error'=> $e->getMessage()]);
        }
    }

    private function grupoEtario($edadArray) 
    { 
        $grupoEtario = array(
            '0 - 10' => 0,
            '11 - 20' => 0,
            '21 - 30' => 0,
            '31 - 40' => 0,
            '41 - 50' => 0,
            '51 - 60' => 0,
            '61 - 70' => 0,
            '71 - 80' => 0,
            '80+' => 0
        );

        foreach ($edadArray as $edad) {
            // dd($edad);
            if ($edad->edad >= 0 && $edad->edad <= 10) {
                $grupoEtario['0 - 10']++;
            } else if ($edad->edad >= 11 && $edad->edad <= 20) {
                $grupoEtario['11 - 20']++;
            } else if ($edad->edad >= 21 && $edad->edad <= 30) {
                $grupoEtario['21 - 30']++;
            } else if ($edad->edad >= 31 && $edad->edad <= 40) {
                $grupoEtario['31 - 40']++;
            } else if ($edad->edad >= 41 && $edad->edad <= 50) {
                $grupoEtario['41 - 50']++;
            } else if ($edad->edad >= 51 && $edad->edad <= 60) {
                $grupoEtario['51 - 60']++;
            } else if ($edad->edad >= 61 && $edad->edad <= 70) {
                $grupoEtario['61 - 70']++;
            } else if ($edad->edad >= 71 && $edad->edad <= 80) {
                $grupoEtario['71 - 80']++;
            } else if ($edad->edad >= 81) {
                $grupoEtario['80+']++;
            }
        }

        // dd($grupoEtario);
        
        return $grupoEtario;
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
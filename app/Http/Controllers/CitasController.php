<?php

namespace App\Http\Controllers;

use App\Models\Consultas;
use App\Models\Pacientes;
use App\Models\Citas;
use App\Models\Medicos;
use Illuminate\Http\Request;


class CitasController extends Controller
{
    public function index()
    {
        $medicos = Medicos::with('usuario.persona')->get();
        $pacientes = Pacientes::with('personas')->get();
        $consultas = Consultas::with('cita.persona.paciente.persona')->get();

        $eventos = [];

        foreach ($consultas as $consulta) {
            if ($consulta->cita) {
                $start = new \DateTime($consulta->start_date, new \DateTimeZone('America/Caracas'));
                $end = new \DateTime($consulta->end_date, new \DateTimeZone('America/Caracas'));
                $evento = [
                    'title' => $consulta->cita->paciente->nombres . ' ' . $consulta->cita->paciente->apellidos,
                    'start' => $start->format(\DateTime::ISO8601),
                    'end' => $end->format(\DateTime::ISO8601),
                    'medicoId' => $consulta->cita->cedulaMedico
                ];
                $eventos[] = $evento;
            }
        }

        return view('citas.index', compact('eventos', 'medicos', 'pacientes'));
    }

    public function getEspecialidadesPorMedico($idMedico)
    {
        $medico = Medicos::findOrFail($idMedico);
        $especialidades = $medico->especialidades()->get();
        return response()->json($especialidades);
    }
}

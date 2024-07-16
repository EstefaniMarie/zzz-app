<?php

namespace App\Http\Controllers;

use App\Models\Consultas;
use App\Models\Citas;
use App\Models\Medicos;
use Illuminate\Http\Request;


class CitasController extends Controller
{
    public function index()
    {
        $medicos = Medicos::with('usuario.persona')->get();
        $consultas = Consultas::with('cita.persona.paciente.persona')->get();

        $eventos = [];

        foreach ($consultas as $consulta) {
            if ($consulta->cita) {
                $start = new \DateTime($consulta->start_date);
                $end = new \DateTime($consulta->end_date);
                $evento = [
                    'title' => $consulta->cita->paciente->nombres . ' ' . $consulta->cita->paciente->apellidos,
                    'start' => $start->format(\DateTime::ISO8601), // Formato ISO8601
                    'end' => $end->format(\DateTime::ISO8601),
                ];
                $eventos[] = $evento;
            }
        }

        return view('citas.index', compact('eventos', 'medicos'));
    }

    public function getCitasxMedico(Request $request)
    {
        $medicoId = $request->input('medicoId');
        $citas = Citas::where('cedulaMedico', $medicoId)
            ->with(['consulta', 'persona.paciente.persona'])
            ->get();

        $citasArray = $citas->map(function ($cita) {
            return [
                'paciente' => [
                    'nombres' => $cita->persona->paciente->persona->nombres,
                    'apellidos' => $cita->persona->paciente->persona->apellidos,
                ],
                'consulta' => [
                    'start_date' => $cita->consulta->start_date,
                    'end_date' => $cita->consulta->end_date,
                ]
            ];
        });

        return response()->json($citasArray);
    }
}

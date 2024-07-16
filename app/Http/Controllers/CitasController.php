<?php

namespace App\Http\Controllers;

use App\Models\Consultas;
use App\Models\Medicos;
use Database\Factories\CitasFactory;


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
                    'end'   => $end->format(\DateTime::ISO8601),
                ];
                $eventos[] = $evento;
            }
        }

        return view('citas.index', compact('eventos', 'medicos'));
    }
}

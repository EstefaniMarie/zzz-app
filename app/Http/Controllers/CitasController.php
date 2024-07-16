<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Medicos;
use Database\Factories\CitasFactory;


class CitasController extends Controller
{
    public function index()
    {
        $medicos = Medicos::with('usuario.persona')->get();
        $citas = Citas::with('persona.paciente')->first();
        $cita = $citas->consulta;
        dd($cita);

        $eventos = [];

        foreach ($citas as $cita) {
            $eventos[] = [
                'title' => $cita->consulta->paciente->nombres . ' ' . $cita->consulta->paciente->apellidos,
                'start' => $cita->consulta->start_date->toIso8601String(),
                'end'   => $cita->consulta->end_date->toIso8601String(),
            ];
        }

        return view('citas.index', compact('eventos', 'medicos'));
    }
}

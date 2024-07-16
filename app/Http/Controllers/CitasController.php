<?php

namespace App\Http\Controllers;

use App\Models\Calendario;


class CitasController extends Controller
{
    public function index()
    {
        $todosEventos = Calendario::all();

        $eventos = [];

        foreach($todosEventos as $evento)
        {
            $eventos[] = [
                'title' => $evento->nombre,
                'start' => $evento->start_date,
                'end' => $evento->end_date
            ];
        }

        return view('citas.index', compact('eventos'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\Models\Consultas;
use App\Models\Pacientes;
use App\Models\Especialidades;

class AdminController extends Controller
{
    public function index()
    {
        $totalConsultasMesActual = Consultas::whereMonth('start_date', Carbon::now()->month)
        ->whereYear('start_date', Carbon::now()->year)
        ->count();

        $totalPacientesRegistrados = Pacientes::count();

        $especialidades = Especialidades::paginate(3); 
        
        return view('dashboard', compact('totalConsultasMesActual', 'totalPacientesRegistrados', 'especialidades'));
    }
}

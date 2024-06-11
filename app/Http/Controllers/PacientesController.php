<?php

namespace App\Http\Controllers;

use App\Models\Procedencias;
use Illuminate\Http\Request;

class PacientesController extends Controller
{
    public function index()
    {
        return view('citas.pacientes');
    }
}
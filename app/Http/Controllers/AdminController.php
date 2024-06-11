<?php

namespace App\Http\Controllers;

use App\Models\Procedencias;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
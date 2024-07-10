<?php

use App\Http\Controllers\AseguradoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\HistoriaController;
use App\Http\Controllers\FamiliaresController;
use App\Http\Controllers\PersonalesController;
use App\Http\Controllers\DiagnosticosController;

use App\Http\Controllers\UserController;
use App\Models\Familiares;
use App\Models\Pacientes;
use App\Models\Personales;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/password', [ProfileController::class, 'update'])->name('password');
});

require __DIR__.'/auth.php';

// Usuarios
Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios');

//Asegurados
Route::get('/otrosAsegurados', [AseguradoController::class, 'getAseguradosJson']);

// Historia Clínica
Route::get('/historiaClinica', [PacientesController::class, 'index'])->name('historiasClinicas');
Route::get('/historiaClinica/detalles/{id}', [PacientesController::class, 'detallesClinicos']);
Route::post('/historiaClinica/paciente/create', [PacientesController::class, 'createPaciente'])->name('añadirPaciente');

// Antecedentes
Route::post('/antecedentesPersonales/nuevo', [PersonalesController::class, 'create'])->name('crearAntecedentePersonal');

Route::get('/antecedentesFamiliares/{idPersona}', [FamiliaresController::class,'getAntecedentesFamiliaresJson']);
Route::post('/antecedentesFamiliares/nuevo', [FamiliaresController::class, 'create'])->name('crearAntecedenteFamiliar');

// Diágnosticos
Route::get('/diagnosticos', [DiagnosticosController::class, 'index'])->name('diagnosticos');
Route::get('/diagnosticos/detalles/{id}', [DiagnosticosController::class, 'detalles'])->name('detallesDiagnosticos');

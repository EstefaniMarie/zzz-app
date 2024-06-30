<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\HistoriaController;

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


// PACIENTES
Route::get('/pacientes', [PacientesController::class, 'index'])->name('pacientes');

// Historia Clínica
Route::get('/historiaClinica', [HistoriaController::class, 'index'])->name('historiasClinicas');
Route::get('/historiaClinica/detalles/{id}', [HistoriaController::class, 'detallesClinicos']);
<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AseguradoController;
use App\Http\Controllers\EstadisticasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\FamiliaresController;
use App\Http\Controllers\PersonalesController;
use App\Http\Controllers\SintomasController;
use App\Http\Controllers\DiagnosticosController;
use App\Http\Controllers\RespaldoController;
use App\Http\Controllers\TratamientosController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\IndicacionesController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\TablasController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\MedicosController;
use App\Http\Controllers\EspecialidadesController;
use App\Http\Controllers\OtrosAseguradosController;

use App\Http\Controllers\UserController;

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

// Recuperacion de contraseña
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

// Usuarios
Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios');
Route::get('/usuarios/{id}/get', [UserController::class, 'userDetails']);
Route::post('/usuarios/edit', [UserController::class, 'editUser']);
Route::post('/usuarios/create', [UserController::class, 'createUser']);

//Respaldos

Route::get('/respaldo', [RespaldoController::class, 'index'])->name('respaldo');
// Route::get('/respaldo/exportar', [RespaldoController::class, 'generarBackup'])->name('generarBackup');
Route::get('/respaldo/sincronizacion', [RespaldoController::class, 'replicarBD'])->name('sincronizacionAuto');
Route::post('/respaldo/sincronizacion/manual', [RespaldoController::class, 'sincronizacionCSV'])->name('sincronizacionManual');

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

// Sintomas
Route::get('/sintomas', [SintomasController::class, 'index'])->name('sintomas');
Route::get('/sintomas/detalles/{cedula}', [SintomasController::class, 'detalles'])->name('detallesSintomas');
Route::post('/prediccion', [SintomasController::class, 'prediccion'])->name('prediccion');
Route::get('/mostrar-modal', [SintomasController::class, 'mostrarModal']);
Route::post('/guardar', [SintomasController::class, 'guardarSintomas'])->name('guardar');


// Diágnosticos
Route::get('/diagnosticos', [DiagnosticosController::class, 'index'])->name('diagnosticos');
Route::get('/diagnosticos/detalles/{cedula}', [DiagnosticosController::class, 'detalles'])->name('detallesDiagnosticos');
Route::get('/get-diagnosticos', [DiagnosticosController::class, 'getDiagnosticos']);
Route::post('/diagnosticosCrear', [DiagnosticosController::class, 'crear'])->name('diagnosticos.crear');

// Tratamientos
Route::get('/tratamientos', [TratamientosController::class, 'index'])->name('tratamientos');
Route::get('/tratamientos/{cedula}', [TratamientosController::class, 'detalles'])->name('detallesTratamientos');
Route::get('/get-tratamientos', [TratamientosController::class, 'getTratamientos']);
Route::post('/tratamientosCrear', [TratamientosController::class, 'crear'])->name('tratamientos.crear');

// INDICACIONES
Route::get('/indicaciones', [IndicacionesController::class, 'index'])->name('indicaciones');
Route::get('/indicaciones/detalles/{cedula}', [IndicacionesController::class, 'detalles'])->name('detallesIndicaciones');
Route::get('/get-indicaciones', [IndicacionesController::class, 'getIndicaciones']);
Route::post('/indicacionesCrear', [IndicacionesController::class, 'crear'])->name('indicaciones.crear');

// CITAS
Route::get('/citas', [CitasController::class, 'index'])->name('citas');
Route::get('/medicos/{medico}/especialidades', [CitasController::class, 'getEspecialidadesPorMedico']);
Route::get('/get-medico-disponibilidad', [CitasController::class, 'getMedicoDisponibilidad'])->name('getMedicoDisponibilidad');
Route::get('/get-horas-disponibles/{medicoId}', [CitasController::class, 'getHorasDisponibles'])->name('getHorasDisponibles');
Route::post('/crearCita', [CitasController::class, 'storeCitas'])->name('storeCitas');


// TABLAS
Route::get('/tablas', [TablasController::class, 'index'])->name('tablas');

// TABLAS - EMPLEADOS
Route::get('/detallesEmpleados', [EmpleadosController::class, 'detallesEmpleados'])->name('detallesEmpleados');
Route::post('/crearEmpleado', [EmpleadosController::class, 'storeEmpleados'])->name('storeEmpleados');
Route::patch('/empleados/{id}/status', [EmpleadosController::class, 'updateStatusEmpleado']);

// TABLAS - MEDICOS
Route::get('/detallesMedicos', [MedicosController::class, 'detallesMedicos'])->name('detallesMedicos');
Route::patch('/medicos/{id}/status', [MedicosController::class, 'updateStatusMedico']);
Route::post('/crearMedico', [MedicosController::class, 'storeMedicos'])->name('storeMedicos');
Route::get('/get-medicos', [MedicosController::class, 'getMedicos']);

// TABLAS - ESPECIALIDADES
Route::get('/detallesEspecialidades', [EspecialidadesController::class, 'detallesEspecialidades'])->name('detallesEspecialidades');
Route::patch('/especialidades/{id}/status', [EspecialidadesController::class, 'updateStatusEspecialidades']);
Route::get('/get-especialidades', [EspecialidadesController::class, 'getEspecialidades']);
Route::post('/crearEspecialidad', [EspecialidadesController::class, 'storeEspecialidades'])->name('storeEspecialidades');

// TABLAS - OTROS ASEGURADOS
Route::get('/detallesOtrosAsegurados', [OtrosAseguradosController::class, 'detallesOtrosAsegurados'])->name('detallesOtrosAsegurados');
Route::patch('/otrosAsegurados/{id}/status', [OtrosAseguradosController::class, 'updateStatusOtroAsegurado']);
Route::post('/crearOtroAsegurado', [OtrosAseguradosController::class, 'storeOtroAsegurado'])->name('storeOtroAsegurado');

// ESTADISTICAS
Route::get('/estadisticas', [EstadisticasController::class, 'index'])->name('estadisticas');
Route::post('/estadisticas/consultasMedico', [EstadisticasController::class,'getConsultasMedico']);
// DASHBOARD
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

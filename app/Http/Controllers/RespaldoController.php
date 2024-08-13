<?php

namespace App\Http\Controllers;

use App\Imports\AseguradoImport;
use App\Imports\EmpleadoImport;
use App\Imports\MedicoImport;
use App\Imports\PersonaImport;
use App\Imports\RespaldoImport;
use App\Models\Empleados;
use App\Models\OtrosAsegurados;
use App\Models\Personas;
use App\Models\Sync;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


use Maatwebsite\Excel\Facades\Excel;

class RespaldoController extends Controller
{
    public function index(){
        $backups = Sync::get();

        return view('respaldo.index', ['syncs' => $backups]);
    }

    //Exportar base de datos
    public function generarBackup(Request $request ) {
        $ruta = $request->input('ruta');
        $filename = \Str::slug(basename($ruta));
        $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
        // dd(Storage::exists('backups/MinAguasBackup_2024-07-31_19-30-402024-07-31-13-30-41.zip'));
        if(!Storage::exists($ruta)){
            return response()->json(['error' => 'El archivo no existe'], 404);
        }

        return Storage::download($ruta, $filename, [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename="'.$filenameWithoutExtension,]);
    }

    //Sincronización manual (tabla por tabla)
    public function sincronizacionCSV(Request $request) {
        try {
            $file = $request->file('BackupManual_csv');
            $tableName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            // dd($tableName);
            switch ($tableName) {
                case 'personas':
                    // dd('sirve');
                    Excel::import(new PersonaImport, $file);
                    break;
                case 'empleados':
                    Excel::import(new EmpleadoImport, $file);
                    break;
                case 'asegurados':
                    Excel::import(new AseguradoImport, $file);
                    break;
                default:
                    throw new \Exception("Tabla no válida", 1);
                    
            }
        
            return redirect()->back()->with(['success' => 'Sincronización exitosa']);
        } catch (\Exception $e) {
            // Manejar la excepción
            return redirect()->back()->with(['error' => 'Error al importar CSV']);
        }
    }

    // Sincronización automática
    public function replicarBD () {
        try {
         $replicaConnection = DB::connection('replica');
 
         $personas = $replicaConnection->table('personas')->get();
         $empleados = $replicaConnection->table('empleados')->get();
         $asegurados = $replicaConnection->table('otrosasegurados')->get();
 
        //  dd($replicaConnection);
 
         $this->personasSync($personas);
         $this->empleadosSync($empleados);
         $this->aseguradoSync($asegurados);

        //  dd($replicaConnection->table('personas')->get());
 
         return redirect()->route('respaldo')->with(['success' => 'Sincronización exitosa']);
        } catch (\Exception $e) {
         //throw $th;
        }
     }

    private function personasSync (Collection $personas) {
        $transactionState = false;
        try {
            DB::transaction(function () use ($personas){
                // dd($personas);
                foreach($personas as $persona) {
                    $persona = (array) $persona;
                    Personas::updateOrCreate(['id' => $persona['id']],
                    [
                        'cedula' => $persona['cedula'],
                        'nombres' => $persona['nombres'],
                        'apellidos' => $persona['apellidos'],
                        'fecha_nacimiento' => $persona['fecha_nacimiento'],
                        'idGenero' => $persona['idgenero'],
                        'crated_at' => $persona['created_at'],
                        'updated_at' => $persona['updated_at']
                    ]);
                }
                $transactionState = true;
            });

            if(!$transactionState){
                throw new \Exception('Sincronización fallida en tabla Personas');
            }

            return;
        } catch (\Exception $e) {
            return $e;
        }
    }

    private function empleadosSync (Collection $empleados) {
        $transactionState = false;
        try {
            DB::transaction(function () use ($empleados){
                foreach($empleados as $empleado) {
                    $empleado = (array) $empleado;
                    Empleados::updateOrCreate(['id' => $empleado['id']],
                        [
                            'idPacientes' => $empleado['idpacientes'],
                            'nombre_unidad' => $empleado['nombre_unidad'],
                            'codigoTrabajador' => $empleado['codigotrabajador'],
                            'estatus' => $empleado['estatus']
                        ]
                    );
                }
                $transactionState = true;
            });

            if(!$transactionState){
                throw new \Exception('Sincronización fallida en tabla Personas');
            }

            return; 
        } catch (\Exception $e) {
            return  $e;
        }
    }

    private function aseguradoSync (Collection $asegurados) {
        $transactionState = false;
        try {
            DB::transaction(function () use ($asegurados){
                foreach($asegurados as $asegurado) {
                    $asegurado = (array) $asegurado;
                    OtrosAsegurados::updateOrCreate(['id' => $asegurado['id']],
                        [
                            'idPacientes' => $asegurado['idpacientes'],
                            'estatus' => $asegurado['estatus'],
                        ]
                    );
                }
                $transactionState = true;
            });

            if(!$transactionState){
                throw new \Exception('Sincronización fallida en tabla Personas');
            }

            return;
        } catch (\Exception $e) {
            return $e;
        }
    }
}

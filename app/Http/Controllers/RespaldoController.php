<?php

namespace App\Http\Controllers;

use App\Imports\AseguradoImport;
use App\Imports\EmpleadoImport;
use App\Imports\MedicoImport;
use App\Imports\PersonaImport;
use App\Imports\RespaldoImport;
use App\Models\Sync;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


use Maatwebsite\Excel\Facades\Excel;

class RespaldoController extends Controller
{
    public function index(){
        $backups = Sync::get();

        return view('respaldo.index', ['syncs' => $backups]);
    }

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

    public function sincronizacionCSV(Request $request) {
        try {
            $archivoCsv = $request->file('BackupManual_csv');
            $tableName = $request->input('ratio');
            $rutaArchivo = $archivoCsv->storeAs('csv', 'importacion.csv');
            // dd($archivoCsv);
            // Ahora puedes utilizar el valor de la primera columna para determinar qué acción tomar
            switch ($tableName) {
                case 'Personas':
                    Excel::import(new PersonaImport, storage_path("/app/$rutaArchivo"));
                    break;
                case 'Empleados':
                    Excel::import(new EmpleadoImport, storage_path("/app/$rutaArchivo"));
                    break;
                case 'Medicos':
                    Excel::import(new MedicoImport, storage_path("/app/$rutaArchivo"));
                    break;
                case 'Asegurados':
                    Excel::import(new AseguradoImport, storage_path("/app/$rutaArchivo"));
                    break;
            }
        
            return redirect()->back()->with(['success' => 'Importación exitosa']);
        } catch (\Exception $e) {
            // Manejar la excepción
            return redirect()->back()->with(['error' => 'Error al importar CSV']);
        }
    }
}

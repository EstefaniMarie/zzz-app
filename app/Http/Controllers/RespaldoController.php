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
            $file = $request->file('BackupManual_csv');
            $tableName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            // dd($tableName);
            switch ($tableName) {
                case 'personas':
                    // dd('sirve');
                    Excel::import(new PersonaImport, $request->file('BackupManual_csv'));
                    break;
                case 'empleados':
                    Excel::import(new EmpleadoImport, $request->file('BackupManual_csv'));
                    break;
                case 'medicos':
                    Excel::import(new MedicoImport, $request->file('BackupManual_csv'));
                    break;
                case 'asegurados':
                    Excel::import(new AseguradoImport, $request->file('BackupManual_csv'));
                    break;
                default:
                    throw new \Exception("Tabla no válida", 1);
                    
            }
        
            return redirect()->back()->with(['success' => 'Importación exitosa']);
        } catch (\Exception $e) {
            // Manejar la excepción
            dd($e);
            // return redirect()->back()->with(['error' => 'Error al importar CSV']);
        }
    }
}

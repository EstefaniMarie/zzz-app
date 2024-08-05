<?php

namespace App\Http\Controllers;

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
        $archivoCsv = $request->file('BackupManual_csv');
        $rutaArchivo = $archivoCsv->storeAs('csv', 'importacion.csv');
    
        Excel::import(new RespaldoImport,  storage_path('app/'. $rutaArchivo));

        // Excel::load(storage_path('app/'. $rutaArchivo), function($reader) {
        //     $datosCsv = $reader->get();
        //     $tablasPermitidas = ['Personas', 'Pacientes', 'Empleados', 'Medicos'];
    
        //     foreach ($datosCsv as $dato) {
        //         $tabla = $dato[0]; // Suponiendo que la primera columna es la tabla
    
        //         if (!in_array($tabla, $tablasPermitidas)) {
        //             // Error: la tabla no es permitida
        //             throw new \Exception("La tabla '$tabla' no es válida");
        //         }
    
        //         $this->procesarDato($dato, $tabla);
        //     }
        // });
    
        return redirect()->back()->with(['success' => 'Importación exitosa']);
    }
    
    // private function procesarDato($dato, $tabla) {
    //     switch ($tabla) {
    //         case 'Personas':
    //             Personas::updateOrCreate([
    //                 'cedula' => $dato[1],
    //                 'nombres' => $dato[2],
    //                 'apellidos' => $dato[3],
    //                 'fecha_nacimiento' => $dato[4],
    //                 'numero_telefono' => $dato[5],
    //                 'idGenero' => $dato[6]
    //             ]);
    //             break;
    //         case 'Pacientes':
    //             Pacientes::updateOrCreate([
    //                 'idPersona' => $dato[1]
    //             ]);
    //             break;
    //         case 'Empleados':
    //             Empleados::updateOrCreate([
    //                 'idPacientes' => $dato[1],
    //                 'nombre_unidad' => $dato[2],
    //                 'codigoTrabajador' => $dato[3]
    //             ]);
    //             break;
    //         case 'Medicos':
    //             Medicos::updateOrCreate([
    //                 'idUsuario' => $dato[1],
    //                 'colegiatura' => $dato[2],
    //                 'diasDisponibles' => $dato[3],
    //                 'horasDisponibles' => $dato[4]
    //             ]);
    //             break;
    //     }
    // }
}

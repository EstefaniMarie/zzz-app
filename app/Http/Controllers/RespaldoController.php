<?php

namespace App\Http\Controllers;

use App\Models\Sync;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

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
}

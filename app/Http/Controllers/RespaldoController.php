<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class RespaldoController extends Controller
{
    public function index(){
        return view('respaldo.index');
    }

    public function generarBackup(Request $request) {
        try {
            Artisan::call('backup:run', ['--only-db' => true]);
    
            $backupFile = storage_path(). "/app/backups/latest.sql";
            if (file_exists($backupFile)) {
                return response()->download($backupFile);
            } else {
                throw new \Exception('Backup file not found');
            }
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

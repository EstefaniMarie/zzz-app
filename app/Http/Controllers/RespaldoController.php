<?php

namespace App\Http\Controllers;

use App\Models\Sync;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class RespaldoController extends Controller
{
    public function index(){
        $backups = Sync::select('created_at')->get();

        return view('respaldo.index', ['syncs' => $backups]);
    }

    public function generarBackup() {
        try {
            exec('php artisan backup:run --only-db > NULL 2>&1 &');
    
            $backupFile = storage_path(). "/app/backups/".date('Y-m-d-H-i-s').".sql";
            $backupUrl = url('/storage/app/'.env('APP_NAME').'/'.date('Y-m-d-H-i-s').'.sql');

            // dd($backupFile);
            dd(\Storage::exists($backupFile));

            if (\Storage::exists($backupFile)) {
                return response()->json(['url' => $backupUrl]);
            } else {
                throw new \Exception('Backup file not found');
            }
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

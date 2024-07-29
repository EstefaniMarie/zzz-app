<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Spatie\Backup\Events\BackupZipWasCreated;

class BackupListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BackupZipWasCreated $event)
    {

        $backup = $event->pathToZip;
        // dd( storage_path('backups/'. basename($backup)));
        DB::table('syncs')->insert([
            'ruta' => 'app/backups/'. basename($backup),
            'created_at' => now()
        ]);
    }
}

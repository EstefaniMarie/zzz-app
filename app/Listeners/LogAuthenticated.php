<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Auth;

class LogAuthenticated
{
    public function handle(Authenticated $event)
    {
        $user = $event->user;
        $user->last_login = now();
        $user->save();
    }
}

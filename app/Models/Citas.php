<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Citas extends Model
{
    protected $table = 'citas';

    use HasFactory;

    protected $fillable = [
        'fecha',
        'hora',
        'Personas_idPersonas'
    ];
}
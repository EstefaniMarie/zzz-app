<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctores extends Model
{
    protected $table = 'doctores';

    use HasFactory;

    protected $fillable = [
        'Usuarios_idUsuarios'
    ];
}
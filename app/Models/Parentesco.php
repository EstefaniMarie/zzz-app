<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parentesco extends Model
{
    protected $table = 'parentescos';

    use HasFactory;

    protected $fillable = [
        'codigoParentesco',
        'descripcion'
    ];
}
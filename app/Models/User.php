<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';

    use HasFactory;

    protected $fillable = [
        'password',
        'email',
        'Personas_idPersonas',
        'Roles_idRoles'
    ];

    public function persona()
    {
        return $this->belongsTo(Personas::class, 'Personas_idPersonas', 'idPersonas');
    }
}

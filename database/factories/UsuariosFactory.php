<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Personas;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UsuariosFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $excluirIds = [1, 2, 3, 4, 5];
        $personas = Personas::whereNotIn('id', $excluirIds)->pluck('id')->all(); 
        $roles = Role::where('id', '!=', 1)->pluck('id')->all();
        return [
            'idPersona' => $this->faker->unique()->randomElement($personas),
            'email' => $this->faker->unique()->safeEmail ?: Str::random(4).'@example.com',
            'password' => bcrypt('123456'),
            'idRol' => $this->faker->randomElement($roles),
        ];
    }
}
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
        $personas = Personas::whereNotIn('idPersonas', $excluirIds)->pluck('idPersonas')->all(); 
        $roles = Role::where('id', '!=', 1)->pluck('id')->all();
        return [
            'Personas_idPersonas' => $this->faker->unique()->randomElement($personas),
            'email' => $this->faker->unique()->safeEmail ?: Str::random(4).'@example.com',
            'password' => bcrypt('123456'),
            'role_id' => $this->faker->randomElement($roles),
        ];
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Especialidades;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(GeneroSeeder::class);
        $this->call(PersonasSeeder::class);
        $this->call(ParentescoSeeder::class);
        $this->call(PacientesSeeder::class);
        $this->call(EmpleadosSeeder::class);

        $permissions = ['list', 'create', 'edit', 'delete'];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roles = [
            'admin' => 1,
            'Medico' => 2,
            'Recepcionista' => 3,
        ];

        foreach ($roles as $name => $id) {
            Role::create(['id' => $id, 'name' => $name]);
        }

        $usersData = [
            [
                'email' => 'admin@example.com',
                'password' => bcrypt('123456'),
                'idPersona' => 2,
                'idRol' => 1,
                'Status' => 1,
                'role_name' => 'admin',
            ],
            [
                'email' => 'medico@example.com',
                'password' => bcrypt('123456'),
                'idPersona' => 3,
                'idRol' => 2,
                'Status' => 1,
                'role_name' => 'Medico',
            ],
            [
                'email' => 'recepcionista@example.com',
                'password' => bcrypt('123456'),
                'idPersona' => 4,
                'idRol' => 3,
                'Status' => 1,
                'role_name' => 'Recepcionista',
            ],
        ];

        foreach ($usersData as $userData) {
            $user = User::create([
                'email' => $userData['email'],
                'password' => $userData['password'],
                'idPersona' => $userData['idPersona'],
                'idRol' => $userData['idRol'],
                'Status' => 1
            ]);
            $user->assignRole($userData['role_name']);
        }

        $this->call(EspecialidadesSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(OtrosAseguradosSeeder::class);
        $this->call(OtrosAseguradosConEmpleadosSeeder::class);
        // $this->call(HistorialSeeder::class);
        $this->call(FamiliaresSeeder::class);
        $this->call(PersonalesSeeder::class);
        $this->call(MedicosSeeder::class);
        $this->call(MedicosConEspecialidadesSeeder::class);
        $this->call(CitasSeeder::class);
        $this->call(ConsultasSeeder::class);
        $this->call(MedicosConConsultasSeeder::class);
        $this->call(SintomasSeeder::class);
        $this->call(ConsultaConSintomasSeeder::class);
        $this->call(DiagnosticosSeeder::class);
        $this->call(SintomasConDiagnosticosSeeder::class);
        $this->call(TratamientosSeeder::class);
        $this->call(DiagnosticosConTratamientosSeeder::class);
        $this->call(IndicacionesSeeder::class);
        $this->call(RecipesSeeder::class);
    }
}

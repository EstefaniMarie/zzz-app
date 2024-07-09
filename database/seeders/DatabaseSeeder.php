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
        $this->call(EmpleadosSeeder::class);

        $permissions = ['list', 'create', 'edit', 'delete'];
        
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roles = [
            'root' => 1,
            'admin' => 2,
            'Medico' => 3,
            'Recepcionista' => 4,
            'Farmaceutico' => 5,
        ];

        foreach ($roles as $name => $id) {
            Role::create(['id' => $id, 'name' => $name]);
        }

        $rootRole = Role::find(1);
        $user = User::create([
            'email' => 'root@example.com', 
            'password' => bcrypt('123456'),
            'idPersona' => 1,
            'idRol' => $rootRole->id,
        ]);

        $allPermissions = Permission::pluck('id')->all();
        $rootRole->syncPermissions($allPermissions);
        $user->assignRole($rootRole->name);


        $usersData = [
            [
                'email' => 'admin@example.com', 
                'password' => bcrypt('123456'),
                'idPersona' => 2,
                'idRol' => 2,
                'role_name' => 'admin',
            ],
            [
                'email' => 'medico@example.com', 
                'password' => bcrypt('123456'),
                'idPersona' => 3,
                'idRol' => 3,
                'role_name' => 'Medico',
            ],
            [
                'email' => 'recepcionista@example.com', 
                'password' => bcrypt('123456'),
                'idPersona' => 4,
                'idRol' => 4,
                'role_name' => 'Recepcionista',
            ],
            [
                'email' => 'farmaceutico@example.com', 
                'password' => bcrypt('123456'),
                'idPersona' => 5,
                'idRol' => 5,
                'role_name' => 'Farmaceutico',
            ],
        ];

        foreach ($usersData as $userData) {
            $user = User::create([
                'email' => $userData['email'],
                'password' => $userData['password'],
                'idPersona' => $userData['idPersona'],
                'idRol' => $userData['idRol'],
            ]);
            $user->assignRole($userData['role_name']);
        }

        $especialidades = [
            ['codigoEspecialidad' => 1, 'descripcion' => 'Ginecobstetra'],
            ['codigoEspecialidad' => 2, 'descripcion' => 'Medico General'],
            ['codigoEspecialidad' => 3, 'descripcion'=> 'Otorrinolaringólogo'],
        ];

       foreach($especialidades as $especialidad) {
            Especialidades::create([
                'codigoEspecialidad' => $especialidad['codigoEspecialidad'],
                'descripcion' => $especialidad['descripcion'],
            ]);
        }
        

        $this->call(UsuariosSeeder::class);
        $this->call(OtrosAseguradosSeeder::class);
        $this->call(OtrosAseguradosConEmpleadosSeeder::class);
        $this->call(PacientesSeeder::class);
        // $this->call(HistorialSeeder::class);
        $this->call(FamiliaresSeeder::class);
        $this->call(PersonalesSeeder::class);
        $this->call(MedicosSeeder::class);
        $this->call(MedicosConEspecialidadesSeeder::class);
        $this->call(CitasSeeder::class);
        $this->call(ConsultasSeeder::class);
        $this->call(MedicosConConsultasSeeder::class);
        $this->call(DiagnosticosSeeder::class);
        $this->call(ConsultaConDiagnosticosSeeder::class);
        $this->call(TratamientosSeeder::class);
        $this->call(DiagnosticosConTratamientosSeeder::class);
        $this->call(IndicacionesSeeder::class);
        $this->call(RecipesSeeder::class);
    }
}
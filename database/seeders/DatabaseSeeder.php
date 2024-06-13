<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        $this->call(EmpleadosSeeder::class);
        $this->call(ParentescoSeeder::class);

        $permissions = ['list', 'create', 'edit', 'delete'];
        
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roles = [
            'root' => 1,
            'admin' => 2,
            'Doctor' => 3,
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
            'role_id' => $rootRole->id,
        ]);

        $allPermissions = Permission::pluck('id')->all();
        $rootRole->syncPermissions($allPermissions);
        $user->assignRole($rootRole->name);


        $usersData = [
            [
                'email' => 'admin@example.com', 
                'password' => bcrypt('123456'),
                'idPersona' => 2,
                'role_id' => 2,
                'role_name' => 'admin',
            ],
            [
                'email' => 'doctor@example.com', 
                'password' => bcrypt('123456'),
                'idPersona' => 3,
                'role_id' => 3,
                'role_name' => 'Doctor',
            ],
            [
                'email' => 'recepcionista@example.com', 
                'password' => bcrypt('123456'),
                'idPersona' => 4,
                'role_id' => 4,
                'role_name' => 'Recepcionista',
            ],
            [
                'email' => 'farmaceutico@example.com', 
                'password' => bcrypt('123456'),
                'idPersona' => 5,
                'role_id' => 5,
                'role_name' => 'Farmaceutico',
            ],
        ];

        foreach ($usersData as $userData) {
            $user = User::create([
                'email' => $userData['email'],
                'password' => $userData['password'],
                'idPersona' => $userData['idPersona'],
                'role_id' => $userData['role_id'],
            ]);
            $user->assignRole($userData['role_name']);
        }

        $this->call(UsuariosSeeder::class);
        $this->call(FarmaceuticoSeeder::class);
        $this->call(OtrosAseguradosSeeder::class);
        $this->call(OtrosAseguradosConEmpleadosSeeder::class);
        $this->call(HistorialSeeder::class);
        $this->call(PersonalesSeeder::class);
        $this->call(FamiliaresSeeder::class);
        $this->call(DoctoresSeeder::class);
        $this->call(EspecialidadesSeeder::class);
        $this->call(CitasSeeder::class);
        $this->call(SintomasSeeder::class);
        $this->call(DoctoresConCitasSeeder::class);
        $this->call(MedicamentosSeeder::class);
        $this->call(MedicamentosConCitasSeeder::class);
        $this->call(DiagnosticosSeeder::class);
        $this->call(TratamientosSeeder::class);
        $this->call(IndicacionesSeeder::class);
    }
}
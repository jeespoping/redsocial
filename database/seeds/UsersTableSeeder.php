<?php

use App\Models\Status;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();
        Role::truncate();
        User::truncate();
        Status::truncate();

        $adminRole = Role::create(['name' => 'Admin', 'display_name' => 'Administrador']);
        $userRole = Role::create(['name' => 'User', 'display_name' => 'Usuario']);
        $courtRole = Role::create(['name' => 'Court', 'display_name' => 'Cancha']);

        $viewCourtsPermission = Permission::create([
           'name' => 'View courts',
            'display_name' => 'Ver canchas',
        ]);
        $createCourtsPermission = Permission::create([
            'name' => 'Create courts',
            'display_name' => 'Crear canchas',
        ]);
        $updateCourtsPermission = Permission::create([
            'name' => 'Update courts',
            'display_name' => 'Actualizar canchas',
        ]);
        $deleteCourtsPermission = Permission::create([
            'name' => 'Delete courts',
            'display_name' => 'Eliminar canchas',
        ]);

        $updateEventsPermission = Permission::create([
            'name' => 'Update events',
            'display_name' => 'Actualizar eventos',
        ]);
        $deleteEventsPermission = Permission::create([
            'name' => 'Delete events',
            'display_name' => 'Eliminar eventos',
        ]);

        $viewChampionshipsPermission = Permission::create([
            'name' => 'View championships',
            'display_name' => 'Ver campeonatos',
        ]);
        $createCourtsPermission = Permission::create([
            'name' => 'Create championships',
            'display_name' => 'Crear campeonatos',
        ]);
        $updateCourtsPermission = Permission::create([
            'name' => 'Update championships',
            'display_name' => 'Actualizar campeonatos',
        ]);
        $deleteCourtsPermission = Permission::create([
            'name' => 'Delete championships',
            'display_name' => 'Eliminar campeonatos',
        ]);

        $admin = new User();
        $admin->name = 'Jesus';
        $admin->first_name = 'Jesus';
        $admin->last_name = 'Lopez';
        $admin->email = 'jeespoping@gmail.com';
        $admin->password = bcrypt('nik.2000');
        $admin->save();

        $admin->assignRole($adminRole);

        $user = new User();
        $user->name = 'Yolima';
        $user->first_name = 'Yolima';
        $user->last_name = 'Florez';
        $user->email = 'yofloji@hotmail.com';
        $user->password = bcrypt('nik.2000');
        $user->save();

        $user->assignRole($userRole);

        $court = new User();
        $court->name = 'Maikol';
        $court->first_name = 'Maikol';
        $court->last_name = 'Guevara';
        $court->email = 'maicolmercadoguevara2001@gmail.com';
        $court->password = bcrypt('nik.2000');
        $court->save();

        $court->assignRole($courtRole);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Permisos
        Permission::create(['name' => 'rol-listar']);
        Permission::create(['name' => 'rol-crear']);
        Permission::create(['name' => 'rol-editar']);
        Permission::create(['name' => 'rol-eliminar']);
        Permission::create(['name' => 'usuario-listar']);
        Permission::create(['name' => 'usuario-crear']);
        Permission::create(['name' => 'usuario-editar']);
        Permission::create(['name' => 'usuario-activar']); 
        Permission::create(['name' => 'tiposolicitud-listar']);
        Permission::create(['name' => 'tiposolicitud-crear']);
        Permission::create(['name' => 'tiposolicitud-editar']);
        Permission::create(['name' => 'tiposolicitud-activar']);
        Permission::create(['name' => 'solicitud-listar']);
        Permission::create(['name' => 'solicitud-crear']);
        Permission::create(['name' => 'solicitud-editar']);
        Permission::create(['name' => 'solicitud-activar']);
        //Roles
        $adminRole = Role::create(['name'  =>  'Administrador']);
        $adminRole->givePermissionTo(Permission::all());

        $sinRole = Role::create(['name'  =>  'Sin permiso']);

        $user = new User;
        $user->name = 'Administrador';
        $user->email = 'administrador@prueba.com';
        $user->password = bcrypt('administrador');
        $user->save();
        $user->assignRole($adminRole);
    }
}

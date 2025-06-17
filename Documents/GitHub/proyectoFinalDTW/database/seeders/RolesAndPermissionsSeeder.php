<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Limpia cache de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        Permission::create(['name' => 'equipment.create']);
        Permission::create(['name' => 'equipment.view']);
        Permission::create(['name' => 'equipment.edit']);
        Permission::create(['name' => 'equipment.delete']);

        // Crear roles
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        // Asignar todos los permisos al rol admin
        $admin->givePermissionTo(Permission::all());

        $user = User::find(1);
        $user->assignRole('admin');

    }
}


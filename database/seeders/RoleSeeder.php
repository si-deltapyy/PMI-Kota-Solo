<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Role Create
        $role_admin = Role::create(['name' => 'admin']);
        $role_relawan = Role::create(['name' => 'relawan']);
        $role_pengelola_profil = Role::create(['name' => 'pengelola_profil']);
        $role_guest = Role::create(['name' => 'guest']);

        //Permission Create
        $permission_edit = Permission::create(['name' => 'edit']);
        $permission_view_dashboard = Permission::create(['name' => 'view_dashboard']);

        //Assign Permision To Role
        $role_admin->givePermissionTo($permission_edit);
        $role_admin->givePermissionTo($permission_view_dashboard);
        $role_relawan->givePermissionTo($permission_view_dashboard);

    }
}

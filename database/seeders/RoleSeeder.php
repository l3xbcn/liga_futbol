<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_viewer = Role::create(['name'=>'Viewer']);
	    $role_editor = Role::create(['name'=>'Editor']);
        $role_admin = Role::create(['name'=>'Admin']);
        $permission_view = Permission::create(['name'=>'view']);
        $permission_edit = Permission::create(['name'=>'edit']);
        $permission_admin = Permission::create(['name'=>'admin']);
        $role_viewer->givePermissionTo($permission_view);
        $role_editor->givePermissionTo($permission_edit, $permission_view);
        $role_admin->givePermissionTo([$permission_admin, $permission_edit, $permission_view]);


	}
}

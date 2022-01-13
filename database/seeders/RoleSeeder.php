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
        $role_admin = Role::create(['name'=>'Admin']);
	    $role_editor = Role::create(['name'=>'Editor']);
        $role_viewer = Role::create(['name'=>'Viewer']);
        $permission_admin = Permission::create(['name'=>'admin']);
        $permission_edit = Permission::create(['name'=>'edit']);
        $role_admin->givePermissionTo([$permission_admin, $permission_edit]);
        $role_editor->givePermissionTo($permission_edit);


	}
}

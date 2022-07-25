<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_user = Role::where('name', 'AM/Sales')->first();
        $role_user->syncPermissions('read data');
        $role_user->syncPermissions('detail data');
        $role_user->syncPermissions('update data');

        $role_superAdmin = Role::where('name', 'Super Admin')->first();
        $role_superAdmin->syncPermissions('read data');
        $role_superAdmin->syncPermissions('detail data');
        $role_superAdmin->syncPermissions('update data');
        $role_superAdmin->syncPermissions('delete data');
    }
}

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
        $role_user->givePermissionTo('read data');
        $role_user->givePermissionTo('detail data');
        $role_user->givePermissionTo('update data');

        $role_superAdmin = Role::where('name', 'Super Admin')->first();
        $role_superAdmin->givePermissionTo('read data');
        $role_superAdmin->givePermissionTo('detail data');
        $role_superAdmin->givePermissionTo('update data');
        $role_superAdmin->givePermissionTo('delete data');
    }
}

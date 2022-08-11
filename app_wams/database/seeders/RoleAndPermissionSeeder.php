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
        $role_user->givePermissionTo('read data AM/Sales');
        $role_user->givePermissionTo('detail data AM/Sales');
        $role_user->givePermissionTo('update data AM/Sales');
        $role_user->givePermissionTo('delete data AM/Sales');

        $role_Management = Role::where('name', 'Management')->first();
        $role_Management->givePermissionTo('read data Management');
        $role_Management->givePermissionTo('detail data Management');
        $role_Management->givePermissionTo('update data Management');
        $role_Management->givePermissionTo('delete data Management');
    }
}

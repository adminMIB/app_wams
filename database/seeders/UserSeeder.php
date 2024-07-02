<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'views']);
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'update']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'approval']);

        // create roles
        $financeRole = Role::create(['name' => 'finance']);
        $financeRole->givePermissionTo('views');
        $financeRole->givePermissionTo('approval');

        $managementRole = Role::create(['name' => 'management']);
        $managementRole->givePermissionTo('views');

        $superAdminRole = Role::create(['name' => 'Super Admin']);
        $superAdminRole->givePermissionTo(['views', 'create', 'update', 'delete', 'approval']);

        // create users using factories
        $userFitri = \App\Models\User::factory()->create([
            'name' => "fitri",
            'email' => "fitrimitraintibersama@mail.com",
            'password' => Hash::make('password'),
            'roles_id' => $financeRole
        ]);
        $userFitri->assignRole($financeRole);

        
        $userCorporate = \App\Models\User::factory()->create([
            'name' => "corporate",
            'email' => "corporatemitraintibersama@mail.com",
            'password' => Hash::make('password'),
            'roles_id' => $managementRole

        ]);
        $userCorporate->assignRole($managementRole);


        $userSuperAdmin = \App\Models\User::factory()->create([
            'name' => "super admin",
            'email' => "superadminmitraintibersama@mail.com",
            'password' => Hash::make('password'),
            'roles_id' => $superAdminRole

        ]);
        $userSuperAdmin->assignRole($superAdminRole);
    }
}

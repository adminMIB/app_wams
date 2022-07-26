<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\RoleHasPermiision;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

         // !buat permisiion
        Permission::create([
            "name" => "read data",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "create data",
            "guard_name" => "web"
        ]);
        

        Permission::create([
            "name" => "detail data",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "update data",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "delete data",
            "guard_name" => "web"
        ]);
    }
}

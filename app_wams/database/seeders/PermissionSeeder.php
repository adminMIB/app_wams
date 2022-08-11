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

         // !buat permisiion PM
        Permission::create([
            "name" => "read data PM",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "create data PM",
            "guard_name" => "web"
        ]);
        

        Permission::create([
            "name" => "detail data PM",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "update data PM",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "delete data PM",
            "guard_name" => "web"
        ]);

         // !buat permisiion AM/Sales
        Permission::create([
            "name" => "read data AM/Sales",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "create data AM/Sales",
            "guard_name" => "web"
        ]);
        

        Permission::create([
            "name" => "detail data AM/Sales",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "update data AM/Sales",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "delete data AM/Sales",
            "guard_name" => "web"
        ]);

         // !buat permisiion Management
        Permission::create([
            "name" => "read data Management",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "create data Management",
            "guard_name" => "web"
        ]);
        

        Permission::create([
            "name" => "detail data Management",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "update data Management",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "delete data Management",
            "guard_name" => "web"
        ]);

         // !buat permisiion Technikal
        Permission::create([
            "name" => "read data Technikal",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "create data Technikal",
            "guard_name" => "web"
        ]);
        

        Permission::create([
            "name" => "detail data Technikal",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "update data Technikal",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "delete data Technikal",
            "guard_name" => "web"
        ]);

         // !buat permisiion Technikal Lead
        Permission::create([
            "name" => "read data Technikal Lead",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "create data Technikal Lead",
            "guard_name" => "web"
        ]);
        

        Permission::create([
            "name" => "detail data Technikal Lead",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "update data Technikal Lead",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "delete data Technikal Lead",
            "guard_name" => "web"
        ]);

         // !buat permisiion PM Lead
        Permission::create([
            "name" => "read data PM Lead",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "create data PM Lead",
            "guard_name" => "web"
        ]);
        

        Permission::create([
            "name" => "detail data PM Lead",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "update data PM Lead",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "delete data PM Lead",
            "guard_name" => "web"
        ]);

         // !buat permisiion Project Admin
        Permission::create([
            "name" => "read data Project Admin",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "create data Project Admin",
            "guard_name" => "web"
        ]);
        

        Permission::create([
            "name" => "detail data Project Admin",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "update data Project Admin",
            "guard_name" => "web"
        ]);

        Permission::create([
            "name" => "delete data Project Admin",
            "guard_name" => "web"
        ]);
    }
}

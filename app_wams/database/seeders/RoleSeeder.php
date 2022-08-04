<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //! Buat role
        Role::create([
            "name" =>  "Super Admin",
            "guard_name" => "web"
        ]);

        // $permision =  Permission::create([
        //     "name" => "read data",
        //     "guard_name" => "web"
        // ]);


        // $admin->givePermissionTo($permision);
        // $permision->assignRole($admin);


        Role::create([
            "name" =>  "AM/Sales",
            "guard_name" => "web"
        ]);

        Role::create([
            "name" =>  "PM",
            "guard_name" =>  "web"
        ]);

        Role::create([
            "name" =>  "Management",
            "guard_name" => "web"
        ]);

        Role::create([
            "name" =>  "Technikal",
            "guard_name" => "web"
        ]);

        Role::create([
            "name" =>  "Technikal Lead",
            "guard_name" => "web"
        ]);


        Role::create([
            "name" =>  "Finance",
            "guard_name" => "web"
        ]);

        Role::create([
            "name" =>  "PM Lead",
            "guard_name" => "web"
        ]);

        Role::create([
            "name" =>  "Project Admin",
            "guard_name" => "web"
        ]);
    }
}

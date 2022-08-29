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

        // $role_Super_Admin = Role::where('name', 'Super Admin')->first();
        // $role_Super_Admin->givePermissionTo('read data AM/Sales');
        // $role_Super_Admin->givePermissionTo('detail data AM/Sales');
        // $role_Super_Admin->givePermissionTo('update data AM/Sales');
        // $role_Super_Admin->givePermissionTo('delete data AM/Sales');
        // $role_Super_Admin->givePermissionTo('create data AM/Sales');


        // $role_Super_Admin->givePermissionTo('read data Management');
        // $role_Super_Admin->givePermissionTo('detail data Management');
        // $role_Super_Admin->givePermissionTo('update data Management');
        // $role_Super_Admin->givePermissionTo('delete data Management');
        // $role_Super_Admin->givePermissionTo('create data Management');


        // $role_Super_Admin->givePermissionTo('read data Technikal');
        // $role_Super_Admin->givePermissionTo('detail data Technikal');
        // $role_Super_Admin->givePermissionTo('update data Technikal');
        // $role_Super_Admin->givePermissionTo('delete data Technikal');
        // $role_Super_Admin->givePermissionTo('create data Technikal');


        // $role_Super_Admin->givePermissionTo('read data Technikal Lead');
        // $role_Super_Admin->givePermissionTo('detail data Technikal Lead');
        // $role_Super_Admin->givePermissionTo('update data Technikal Lead');
        // $role_Super_Admin->givePermissionTo('delete data Technikal Lead');
        // $role_Super_Admin->givePermissionTo('create data Technikal Lead');

        // $role_Super_Admin->givePermissionTo('read data PM Lead');
        // $role_Super_Admin->givePermissionTo('detail data PM Lead');
        // $role_Super_Admin->givePermissionTo('update data PM Lead');
        // $role_Super_Admin->givePermissionTo('delete data PM Lead');
        // $role_Super_Admin->givePermissionTo('create data PM Lead');

        // $role_Super_Admin->givePermissionTo('read data Project Admins');
        // $role_Super_Admin->givePermissionTo('detail data Project Admins');
        // $role_Super_Admin->givePermissionTo('update data Project Admins');
        // $role_Super_Admin->givePermissionTo('delete data Project Admins');
        // $role_Super_Admin->givePermissionTo('create data Project Admins');

        // $role_Super_Admin->givePermissionTo('read data PM');
        // $role_Super_Admin->givePermissionTo('detail data PM');
        // $role_Super_Admin->givePermissionTo('update data PM');
        // $role_Super_Admin->givePermissionTo('delete data PM');
        // $role_Super_Admin->givePermissionTo('create data PM');


        //! AM/Sales
        $role_user = Role::where('name', 'AM/Sales')->first();
        $role_user->givePermissionTo('read data AM/Sales');
        $role_user->givePermissionTo('detail data AM/Sales');
        $role_user->givePermissionTo('update data AM/Sales');
        $role_user->givePermissionTo('delete data AM/Sales');
        $role_user->givePermissionTo('create data AM/Sales');

        //! Management 
        $role_Management = Role::where('name', 'Management')->first();
        $role_Management->givePermissionTo('read data Management');
        $role_Management->givePermissionTo('detail data Management');
        $role_Management->givePermissionTo('update data Management');
        $role_Management->givePermissionTo('delete data Management');
        $role_Management->givePermissionTo('create data Management');

        //! Technikal 
        $role_Technikal = Role::where('name', 'Technikal')->first();
        $role_Technikal->givePermissionTo('read data Technikal');
        $role_Technikal->givePermissionTo('detail data Technikal');
        $role_Technikal->givePermissionTo('update data Technikal');
        $role_Technikal->givePermissionTo('delete data Technikal');
        $role_Technikal->givePermissionTo('create data Technikal');

        //! Technikal Lead 
        $role_Technikal_Lead = Role::where('name', 'Technikal Lead')->first();
        $role_Technikal_Lead->givePermissionTo('read data Technikal Lead');
        $role_Technikal_Lead->givePermissionTo('detail data Technikal Lead');
        $role_Technikal_Lead->givePermissionTo('update data Technikal Lead');
        $role_Technikal_Lead->givePermissionTo('delete data Technikal Lead');
        $role_Technikal_Lead->givePermissionTo('create data Technikal Lead');

        //! PM Lead 
        $role_PM_Lead = Role::where('name', 'PM Lead')->first();
        $role_PM_Lead->givePermissionTo('read data PM Lead');
        $role_PM_Lead->givePermissionTo('detail data PM Lead');
        $role_PM_Lead->givePermissionTo('update data PM Lead');
        $role_PM_Lead->givePermissionTo('delete data Technikal');
        $role_PM_Lead->givePermissionTo('create data Technikal');

        //! Project Admin 
        $role_Project_Admins = Role::where('name', 'Project Admins')->first();
        $role_Project_Admins->givePermissionTo('read data Project Admins');
        $role_Project_Admins->givePermissionTo('detail data Project Admins');
        $role_Project_Admins->givePermissionTo('update data Project Admins');
        $role_Project_Admins->givePermissionTo('delete data Project Admins');
        $role_Project_Admins->givePermissionTo('create data Project Admins');

        //! Project PM 
        $role_PM = Role::where('name', 'PM')->first();
        $role_PM->givePermissionTo('read data PM');
        $role_PM->givePermissionTo('detail data PM');
        $role_PM->givePermissionTo('update data PM');
        $role_PM->givePermissionTo('delete data PM');
        $role_PM->givePermissionTo('create data PM');
    }
}

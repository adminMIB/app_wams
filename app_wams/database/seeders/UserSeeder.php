<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // !buat akun 
        // user admin
        $Superadmin = User::create([
            'name' => "superadmin",
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $Superadmin->assignRole('Super Admin');

        $admin = User::create([
            'name' => "admin",
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $admin->assignRole('Project Admin');
        

        $techLead = User::create([
            'name' => "lead123",
            'email' => 'lead@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $techLead->assignRole('Technikal Lead');

        // //!/ user Managemnt
        $user = User::create([
            'name' => "arizd",
            'email' => 'arizd@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $user->assignRole('Management');

        // //!/ user AM SALES
        // sales order
        $althaf = User::create([
            'name' => "althaf",
            'email' => 'althaf@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $althaf->assignRole('AM/Sales');

        // // sales opty
        $najwa = User::create([
            'name' => "najwa",
            'email' => 'najwa@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $najwa->assignRole('AM/Sales');

        // // //!/ user PM
        $adit = User::create([
            'name' => "Adhit",
            'email' => 'adhit@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // // kita asiggin rolenya
        $adit->assignRole('PM');

        //  //!/ user Technikal
        $rifqi = User::create([
            'name' => "rifqi",
            'email' => 'rifqi@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $rifqi->assignRole('Technikal');

        $fadli = User::create([
            'name' => "fadli",
            'email' => 'fadli@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $fadli->assignRole('Technikal');

         //!/ user Finance
        // $user = User::create([
        //     'name' => "arizd",   
        //     'email' => 'arizd@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $user->assignRole('Finance');

         //!/ user PM Lead
        $fajar = User::create([
            'name' => "fajar",
            'email' => 'fajar@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $fajar->assignRole('PM Lead');
     }
}

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
        $admin = User::create([
            'name' => "godz",
            'email' => 'godz@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $admin->assignRole('Technikal');

        //!/ user Managemnt
        // $user = User::create([
        //     'name' => "arizd",
        //     'email' => 'arizd@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $user->assignRole('Management');

        // //!/ user AM SALES
        // $user = User::create([
        //     'name' => "arizd",
        //     'email' => 'arizd@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $user->assignRole('AM/Sales');

        // //!/ user PM
        // $user = User::create([
        //     'name' => "arizd",
        //     'email' => 'arizd@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $user->assignRole('PM');

        //  //!/ user Technikal
        // $user = User::create([
        //     'name' => "arizd",
        //     'email' => 'arizd@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $user->assignRole('Technikal');

        //  //!/ user Finance
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

        //  //!/ user PM Lead
        // $user = User::create([
        //     'name' => "arizd",
        //     'email' => 'arizd@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $user->assignRole('PM Lead');
    }
}

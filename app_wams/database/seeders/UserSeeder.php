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

        // //!/ user AM SALES

        $dianLubis = User::create([
            'name' => "Dian Lubis",
            'email' => 'dian_lubis@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin1'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $dianLubis->assignRole('AM/Sales');

        $dianOctavia = User::create([
            'name' => "Dian Octavia",
            'email' => 'dian@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin1'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $dianOctavia->assignRole('AM/Sales');
        
       
        
        // $inckasukmawati = User::create([
        //     'name' => "Incka Sukmawati",
        //     'email' => 'incka_sukmawati@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $inckasukmawati->assignRole('AM/Sales');
        
        $meita = User::create([
            'name' => "Meita",
            'email' => 'meita@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin1'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $meita->assignRole('AM/Sales');
        // last AM/Sales

        // user pm
        // $bobbywibowo = User::create([
        //     'name' => "Bobby Wibowo",
        //     'email' => 'bobby_wibowo@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('admin1'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // // kita asiggin rolenya
        // $bobbywibowo->assignRole('PM');
        
        //! PM
        $pipikelana = User::create([
            'name' => "Pipi Kelana",
            'email' => 'pipi_kelana@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin1'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // // kita asiggin rolenya
        $pipikelana->assignRole('PM');
        
        // $firman = User::create([
        //     'name' => "Firman",
        //     'email' => 'firman@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // // kita asiggin rolenya
        // $firman->assignRole('PM');
        
        $ronaldnapitupulu = User::create([
            'name' => "Ronald Napitupulu",
            'email' => 'ronald@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin1'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // // kita asiggin rolenya
        $ronaldnapitupulu->assignRole('PM');
        // last user pm

        //  //!/ user Technikal
        // $ali = User::create([
        //     'name' => "ali",
        //     'email' => 'ali@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $ali->assignRole('Technikal');
        
        // $febry = User::create([
        //     'name' => "febry",
        //     'email' => 'febry@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $febry->assignRole('Technikal');
        
        // $julian = User::create([
        //     'name' => "julian",
        //     'email' => 'julian@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $julian->assignRole('Technikal');
        
        // $socrates = User::create([
        //     'name' => "socrates",
        //     'email' => 'socrates@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $socrates->assignRole('Technikal');
        
        // $sandy = User::create([
        //     'name' => "sandy",
        //     'email' => 'sandy@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $sandy->assignRole('Technikal');

        // //  //!/ user Technikal
        // $rifqi = User::create([
        //     'name' => "rifqi",
        //     'email' => 'rifqi@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $rifqi->assignRole('Technikal');

        $fathur = User::create([
            'name' => "fathur",
            'email' => 'fathur@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin1'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $fathur->assignRole('Technikal');
        
        $nino = User::create([
            'name' => "Nino",
            'email' => 'nino@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin1'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $nino->assignRole('Technikal');
        
        // $fadli = User::create([
        //     'name' => "fadli",
        //     'email' => 'fadli@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $fadli->assignRole('Technikal');
        
        // $althaf = User::create([
        //     'name' => "althaf",
        //     'email' => 'althaf@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $althaf->assignRole('Technikal');
        
        // $arizd = User::create([
        //     'name' => "arizd",
        //     'email' => 'arizd@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $arizd->assignRole('Technikal');
        
        // $adhit = User::create([
        //     'name' => "adhit",
        //     'email' => 'adhit@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $adhit->assignRole('Technikal');
        
        // $sofyan = User::create([
        //     'name' => "sofyan",
        //     'email' => 'sofyan@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $sofyan->assignRole('Technikal');

         //!/ user Finance
        $rina = User::create([
            'name' => "Rina",   
            'email' => 'rina@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin1'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $rina->assignRole('Finance');

        // user admin default
        $Superadmin = User::create([
            'name' => "superadmin",
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin1'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $Superadmin->assignRole('Super Admin');

        // ! user admin default
        $admin = User::create([
            'name' => "Jayanti",
            'email' => 'jayanti@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin1'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $admin->assignRole('Project Admins');
        
        // $sales = User::create([
        //     'name' => "sales",
        //     'email' => 'sales@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $sales->assignRole('AM/Sales');

        // //!/ user Managemnt default
        $management = User::create([
            'name' => "Direksi",
            'email' => 'direksi@mitraintibersama.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin1'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $management->assignRole('Management');

        // //!/ user PM default
        // $pm = User::create([
        //     'name' => "pm",
        //     'email' => 'pm@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // // kita asiggin rolenya
        // $pm->assignRole('PM');

        // $technikal = User::create([
        //     'name' => "technikal",
        //     'email' => 'technikal@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // // kita asiggin rolenya
        // $technikal->assignRole('Technikal');

         //! user finance default
        $finace = User::create([
            'name' => "finace",
            'email' => 'finace@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $finace->assignRole('Finance');
        
        //! user corporate default
        $finace = User::create([
            'name' => "corporate",
            'email' => 'corporate@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // kita asiggin rolenya
        $finace->assignRole('Corporate');
     }
}

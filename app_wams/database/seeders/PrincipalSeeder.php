<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Principal;

class PrincipalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Principal::create([            
            "name" => "Fujitsu",
        ]);
        
        Principal::create([
            "name" => "Bundle Solution"
        ]);

        Principal::create([
            "name" => "Microsoft"
        ]);

        Principal::create([
            "name" => "Oracle"
        ]);


        Principal::create([
            "name" => "Red Hat"
        ]);

        Principal::create([
            "name" => "Others Principal"
        ]);
        

        Principal::create([
            "name" => "Tableau"
        ]);

        Principal::create([
            "name" => "Fortinet"
        ]);

        Principal::create([
            "name" => "Fujitsu"
        ]);

        Principal::create([
            "name" => "Evodia"
        ]);

        Principal::create([
            "name" => "MIB"
        ]);

        Principal::create([
            "name" => "iTrust"
        ]);

        Principal::create([
            "name" => "Advance AI "
        ]);

        Principal::create([
            "name" => "Internal MIB Group"
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Sbu;
use Illuminate\Database\Seeder;

class SbuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sbu::create([
            "name" =>  "PT. MIB"
        ]);
        
        Sbu::create([
            "name" =>  "PT. Amoro"
        ]);
        
        Sbu::create([
            "name" =>  "PT. DTQ"
        ]);
        
        Sbu::create([
            "name" =>  "PT. DTT"
        ]);
        
        Sbu::create([
            "name" =>  "PT. AAA"
        ]);
        
        Sbu::create([
            "name" =>  "PT. LJN"
        ]);
    }
}

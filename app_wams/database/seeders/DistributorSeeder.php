<?php

namespace Database\Seeders;

use App\Models\Distributor;
use Illuminate\Database\Seeder;

class DistributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Distributor::create([            
            "distributor" => "SMI",
        ]);
        
        Distributor::create([
            "distributor" => "ECS"
        ]);

        Distributor::create([
            "distributor" => "Virtus"
        ]);

        Distributor::create([
            "distributor" => "Ingram"
        ]);


        Distributor::create([
            "distributor" => "CDT"
        ]);

        Distributor::create([
            "distributor" => "TechData"
        ]);
        

        Distributor::create([
            "distributor" => "BPT"
        ]);

        Distributor::create([
            "distributor" => "MBT"
        ]);

        Distributor::create([
            "distributor" => "MTech"
        ]);

        Distributor::create([
            "distributor" => "Entrust"
        ]);

        Distributor::create([
            "distributor" => "Sistech"
        ]);

        Distributor::create([
            "distributor" => "Join Disti"
        ]);

        Distributor::create([
            "distributor" => "Direct Principal/Partnet"
        ]);

       
    }
}

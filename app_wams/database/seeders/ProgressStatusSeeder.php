<?php

namespace Database\Seeders;

use App\Models\ProgressStatus;
use Illuminate\Database\Seeder;

class ProgressStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProgressStatus::create([
            "title" =>  "Presentation/Demo"
        ]);
        
        ProgressStatus::create([
            "title" =>  "Send Proposal"
        ]);
        
        ProgressStatus::create([
            "title" =>  "Proc. Process"
        ]);
        
        ProgressStatus::create([
            "title" =>  "Bidding"
        ]);
        
        ProgressStatus::create([
            "title" =>  "SPPBJ"
        ]);
        
        ProgressStatus::create([
            "title" =>  "PO/Contract"
        ]);
        
        ProgressStatus::create([
            "title" =>  "Lost"
        ]);
    }
}

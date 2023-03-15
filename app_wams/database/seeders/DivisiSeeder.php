<?php

namespace Database\Seeders;

use App\Models\Divisi;
use Illuminate\Database\Seeder;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Divisi::create([            
            "nama_divisi" => "Account Manager",
        ]);
        
        Divisi::create([            
            "nama_divisi" => "Business Channel",
        ]);
        
        Divisi::create([            
            "nama_divisi" => "Management",
        ]);
        
        Divisi::create([            
            "nama_divisi" => "PMO",
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOpty extends Model
{
    use HasFactory;

    protected $fillable =[
        "NamaClient","NamaProject","Date", "Angka","Status","Note", "Timeline" 
    ];

    // public function timelines()
    // {
    //     return $this->belongsTo(Timeline::class, 'timeline');
    // }
}

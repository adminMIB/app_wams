<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOpty extends Model
{
    use HasFactory;

    protected $fillable =[
        "NamaClient","NamaProject","Timeline","Date", "Angka","Status","Note","elearning_id"
    ];

    public function elearnings()
    {
       return $this->belongsTo(Elearning::class, 'elearning_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bast extends Model
{
    use HasFactory;

    protected $fillable=[
        "status","bast_dokumen","so_id"
    ];

    public function so()
    {
        return $this->belongsTo(SalesOrder::class, 'so_id');
    }
}

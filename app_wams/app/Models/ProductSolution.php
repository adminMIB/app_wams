<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSolution extends Model
{
    use HasFactory;

    protected $fillable=[
        "tes","amount","so_id"
    ];

    public function sorders()
    {
        return $this->belongsTo(SalesOrder::class, 'so_id');
    }
}

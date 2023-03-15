<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amount extends Model
{
    use HasFactory;

    protected $fillable=[
        "title","amount","salesorders_id"
    ];

    public function sorders()
    {
        return $this->belongsTo(SalesOrder::class, 'salesorders_id');
    }
}

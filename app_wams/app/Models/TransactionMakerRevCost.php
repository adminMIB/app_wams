<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionMakerRevCost extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function tmaker()
    {
        return $this->belongsTo(SaldoAwal::class, 'sldawl_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionMakerDcl extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function tmaker()
    {
        return $this->belongsTo(OpptyProject::class, 'picdisti_id');
    }
}

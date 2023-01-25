<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionMakerReimbursement extends Model
{
    use HasFactory;

    protected $guarded = ["id"];
    protected $dates = ['date'];

    public function tmaker()
    {
        return $this->belongsTo(OpptyProject::class, 'opptyproject_id');
    }
}

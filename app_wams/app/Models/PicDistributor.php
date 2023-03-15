<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PicDistributor extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function detailtmdcl()
    {
        return $this->hasMany(TransactionMakerDcl::class, 'picdisti_id');
    }
}

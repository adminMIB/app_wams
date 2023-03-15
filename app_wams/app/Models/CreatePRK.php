<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatePRK extends Model
{
    use HasFactory;

    protected $fillable =[
        "pengajuan_cl","jumlah_cl","jenis_kolateral","keterangan"
    ];

    public function tmcmm()
    {
        return $this->hasMany(TransactionMakerCMM::class, 'cmm_id');
    }
}

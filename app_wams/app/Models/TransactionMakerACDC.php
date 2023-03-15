<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionMakerACDC extends Model
{
    use HasFactory;

    protected $fillable =[
        "tanggal" , "jenis_transaksi" , "nama_tujuan" , "nominal" , "keterangan" , "upload_request" , "upload_release","cpt_id"
    ];

    public function cpt()
    {
        return $this->belongsTo(CreateProject::class, 'cpt_id');
    }
}

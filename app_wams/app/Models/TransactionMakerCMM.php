<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionMakerCMM extends Model
{
    use HasFactory;

    protected $fillable =[
        "tgl_po","nama_project","nama_klien","nama_eu","nominal_po","cmm_id"
    ];
}

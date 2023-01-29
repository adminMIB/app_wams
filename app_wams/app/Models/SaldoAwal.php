<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoAwal extends Model
{
    use HasFactory;

    protected $fillable=[
        "jumlah_saldo",
        "tanggal_salo"
    ];

    public function detailtmrevcost()
    {
        return $this->hasMany(TransactionMakerRevCost::class, 'sldawl_id');
    }
}
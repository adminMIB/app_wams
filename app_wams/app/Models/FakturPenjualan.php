<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakturPenjualan extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function pesanan()
    {
        return $this->belongsTo(PenawaranPesanan::class, 'pesanan_id');
    }

    public function barangfaktur()
    {
        return $this->hasMany(BarangFaktur::class, 'fajul_id');
    }
}

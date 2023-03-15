<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangFaktur extends Model
{
    use HasFactory;

    protected $fillable = ["nama_barang", "kuantitas", "harga", "hargakuan", "diskon","ppn","total_harga","total_ppn","total_diskon","total","fajul_id"];

    public function fp()
    {
        return $this->belongsTo(FakturPenjualan::class, 'fajul_id');
    }
}

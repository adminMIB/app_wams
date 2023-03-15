<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangFakturPembelian extends Model
{
    use HasFactory;

    protected $fillable = ["nama_barang", "kuantitas", "harga", "hargakuan","diskon","ppn","total_harga","total_ppn","total_diskon","total","fapem_id"];

    public function fpn()
    {
        return $this->belongsTo(FakturPembelian::class, 'fapem_id');
    }

    
}

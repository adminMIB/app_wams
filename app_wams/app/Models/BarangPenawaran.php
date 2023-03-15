<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangPenawaran extends Model
{
    use HasFactory;

    protected $fillable = ["nama_barang", "kuantitas", "harga", "diskon","ppn","total_harga","total_ppn","total_diskon","total","penjul_id"];

    public function pp()
    {
        return $this->belongsTo(PenawaranPesanan::class, 'penjul_id');
    }
}

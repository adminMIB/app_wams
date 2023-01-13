<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangPembelian extends Model
{
    use HasFactory;

    protected $fillable = ["kode", "nama_barang", "kuantitas", "harga","hargakuan", "diskon","total_harga","total_diskon","total","pembelian_id","ppn","total_ppn"];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'pembelian_id');
    }

}

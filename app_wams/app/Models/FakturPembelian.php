<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakturPembelian extends Model
{
    use HasFactory;
    protected $fillable = ["nama_client", "no_form", "tanggal_faktur", "mata_uang", "tgl_pengiriman", "no_faktur", "pengiriman","pajak","alamat", "syarat_pembayaran", "FOB","status","keterangan", "total", "metode_pembayaran", "nilai_pembayaran", "no_bukti", "tgl_bayar", "bank", "pembelian_id"];



    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'pembelian_id');
    }

    public function fakturpembelian()
    {
        return $this->hasMany(BarangFakturPembelian::class, 'fapem_id');
    }
}

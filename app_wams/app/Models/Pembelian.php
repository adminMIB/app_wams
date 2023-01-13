<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $fillable = ["nama_client", "tgl_penjualan", "no_penjualan", "kode_project","nama_disti","departemen","syarat_pembayaran","alamat","pajak","keterangan","pengiriman","FOB","status","tgl_pengiriman","lto_id"];

    public function lto()
    {
        return $this->belongsTo(SalesOrder::class, 'lto_id');
    }

    public function fakturPembelian()
    {
        return $this->hasMany(FakturPembelian::class, 'pembelian_id');
    }

    public function barang()
    {
        return $this->hasMany(BarangPembelian::class, 'pembelian_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenawaranPesanan extends Model
{
    use HasFactory;

    protected $fillable = ["nama_client", "tgl_penjualan", "no_penjualan", "kode_project","nama_disti","departemen","proyek","syarat_pembayaran","alamat","pajak","cabang","keterangan","pengiriman","FOB","mata_uang","status","nopo","tgl_pengiriman","tutup_pesanan","lto_id","no_pesanan"];

    public function barang()
    {
        return $this->hasMany(BarangPenawaran::class, 'penjul_id');
    }
    
    public function faktur()
    {
        return $this->hasMany(FakturPenjualan::class, 'pesanan_id');
    }

    public function lto()
    {
        return $this->belongsTo(SalesOrder::class, 'lto_id');
    }
}

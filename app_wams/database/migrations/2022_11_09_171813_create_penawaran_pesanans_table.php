<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenawaranPesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penawaran_pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_client');
            $table->string('tgl_penjualan');
            $table->string('no_penjualan');
            $table->string('no_pesanan')->nullable();
            $table->string('kode_project');
            $table->string('nama_disti');
            $table->string('departemen');
            $table->string('proyek');
            $table->string('syarat_pembayaran')->nullable();
            $table->string('alamat');
            $table->string('pajak');
            $table->string('cabang');
            $table->string('keterangan')->nullable();
            $table->string('pengiriman')->nullable();
            $table->string('FOB')->nullable();
            $table->string('mata_uang');
            $table->string('nopo')->nullable();
            $table->string('tgl_pengiriman')->nullable();
            $table->string('tutup_pesanan')->nullable();
            $table->string('status')->default('menunggu proses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penawaran_pesanans');
    }
}

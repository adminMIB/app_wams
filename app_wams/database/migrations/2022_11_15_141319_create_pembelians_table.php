<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('nama_client');
            $table->string('tgl_penjualan');
            $table->string('no_penjualan');
            $table->string('kode_project');
            $table->string('nama_disti')->nullable();
            $table->string('departemen')->nullable();
            $table->string('syarat_pembayaran')->nullable();
            $table->string('alamat');
            $table->string('pajak')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('pengiriman')->nullable();
            $table->string('FOB')->nullable();
            // $table->string('mata_uang');
            // $table->string('nopo');
            $table->string('tgl_pengiriman');
            $table->string('status')->default('Menunggu diproses');
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
        Schema::dropIfExists('pembelians');
    }
}

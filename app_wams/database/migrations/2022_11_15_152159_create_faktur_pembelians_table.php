<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakturPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faktur_pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('nama_client');
            $table->string('no_form');
            $table->date('tanggal_faktur');
            $table->string('mata_uang');
            $table->date('tgl_pengiriman');
            $table->string('no_faktur');
            $table->string('pengiriman')->nullable();
            $table->string('pajak')->nullable();
            $table->string('alamat');
            $table->integer('total');
            $table->string('bank')->nullable();
            $table->string('syarat_pembayaran');
            $table->string('metode_pembayaran')->nullable();
            $table->integer('nilai_pembayaran')->nullable();
            $table->string('no_bukti')->nullable();
            $table->string('tgl_bayar')->nullable();
            $table->string('FOB')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('faktur_pembelians');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakturPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faktur_penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_client');
            $table->string('tgl_pesanan');
            $table->string('no_faktur');
            $table->integer('no_po');
            $table->string('pajak');
            $table->string('mata_uang');
            $table->string('jenis_dok');
            $table->string('no_faktur_pajak');
            $table->string('tgl_faktur');
            $table->string('alamat');
            $table->string('cabang');
            $table->string('tgl_pengiriman');
            $table->string('pengiriman')->nullable();
            $table->string('syarat_pembayaran');
            $table->string('FOB');
            $table->string('end_user');
            $table->string('status')->default('Belum Lunas');
            $table->string('attention');
            $table->string('bank');
            $table->string('metode_pembayaran')->nullable();
            $table->integer('nilai_pembayaran')->nullable();
            $table->string('no_bukti')->nullable();
            $table->string('tgl_bayar')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('total');
            $table->string('phone')->nullable();
            $table->string('npwp')->nullable();
            $table->string('umur')->nullable();
            $table->string('biayalain')->nullable();
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
        Schema::dropIfExists('faktur_penjualans');
    }
}

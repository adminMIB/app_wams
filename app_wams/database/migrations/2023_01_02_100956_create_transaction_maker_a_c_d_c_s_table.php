<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionMakerACDCSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_maker_a_c_d_c_s', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->string('jenis_transaksi');
            $table->string('nama_tujuan');
            $table->bigInteger('nominal');
            $table->string('keterangan');
            $table->string('upload_request');
            $table->string('upload_release');
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
        Schema::dropIfExists('transaction_maker_a_c_d_c_s');
    }
}

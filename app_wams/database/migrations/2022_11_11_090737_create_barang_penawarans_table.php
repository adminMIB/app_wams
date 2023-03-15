<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangPenawaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_penawarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->integer('kuantitas');
            $table->string('satuan')->nullable();
            $table->integer('harga');
            $table->integer('hargakuan');
            $table->integer('diskon')->nullable();
            $table->integer('ppn')->nullable();
            $table->integer('total_harga');
            $table->integer('total_ppn')->nullable();
            $table->integer('total_diskon')->nullable();
            $table->integer('total')->nullable();
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
        Schema::dropIfExists('barang_penawarans');
    }
}

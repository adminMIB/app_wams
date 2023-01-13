<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsPembelianIdToBarangPembelian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang_pembelians', function (Blueprint $table) {
            $table->foreignId('pembelian_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang_pembelians', function (Blueprint $table) {
            $table->dropForeign(['pembelian_id']);
        });
    }
}

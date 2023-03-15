<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsFakturPenjualansToPenawaranPesanans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faktur_penjualans', function (Blueprint $table) {
            $table->foreignId('pesanan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faktur_penjualans', function (Blueprint $table) {
            $table->dropForeign(['pesanan_id']);
        });
    }
}

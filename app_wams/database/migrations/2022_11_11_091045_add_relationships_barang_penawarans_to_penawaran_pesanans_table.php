<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsBarangPenawaransToPenawaranPesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang_penawarans', function (Blueprint $table) {
            $table->foreignId('penjul_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang_penawarans', function (Blueprint $table) {
            $table->dropForeign(['penjul_id']);
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsBarangFakturPembeliansToFakturPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang_faktur_pembelians', function (Blueprint $table) {
            $table->foreignId('fapem_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang_faktur_pembelians', function (Blueprint $table) {
            $table->dropForeign(['fapem_id']);
        });
    }
}

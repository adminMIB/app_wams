<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsBarangFaktursToFakturPenjualans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang_fakturs', function (Blueprint $table) {
            $table->foreignId('fajul_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang_fakturs', function (Blueprint $table) {
            $table->dropForeign(['fajul_id']);
        });
    }
}

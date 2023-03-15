<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsPenawaranPesanansToSalesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penawaran_pesanans', function (Blueprint $table) {
            $table->foreignId('lto_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penawaran_pesanans', function (Blueprint $table) {
            $table->dropForeign(['lto_id']);
        });
    }
}

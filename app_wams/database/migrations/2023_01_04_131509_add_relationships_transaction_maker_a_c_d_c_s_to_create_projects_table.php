<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsTransactionMakerACDCSToCreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_maker_a_c_d_c_s', function (Blueprint $table) {
            $table->foreignId('cpt_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_maker_a_c_d_c_s', function (Blueprint $table) {
            $table->dropForeign(['cpt_id']);
        });
    }
}

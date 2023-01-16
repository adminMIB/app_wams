<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsTransactionMakerCMMSToCreatePRKSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_maker_c_m_m_s', function (Blueprint $table) {
            $table->foreignId('cmm_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_maker_c_m_m_s', function (Blueprint $table) {
            $table->dropForeign(['cmm_id']);
        });
    }
}

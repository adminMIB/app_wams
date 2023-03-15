<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsPicDistributorsToTransactionMakerDcls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_maker_dcls', function (Blueprint $table) {
            $table->foreignId('picdisti_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_maker_dcls', function (Blueprint $table) {
            $table->dropForeign(['picdisti_id']);
        });
    }
}

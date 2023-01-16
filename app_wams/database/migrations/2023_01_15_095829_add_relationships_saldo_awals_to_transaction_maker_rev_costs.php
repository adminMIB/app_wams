<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsSaldoAwalsToTransactionMakerRevCosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_maker_rev_costs', function (Blueprint $table) {
            $table->foreignId('sldawl_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_maker_rev_costs', function (Blueprint $table) {
            $table->dropForeign(['sldawl_id']);
        });
    }
}

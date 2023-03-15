<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsOpptyProjectsToTransactionMakerReimbursements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_maker_reimbursements', function (Blueprint $table) {
            $table->foreignId('opptyproject_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_maker_reimbursements', function (Blueprint $table) {
            $table->dropForeign(['opptyproject_id']);
        });
    }
}

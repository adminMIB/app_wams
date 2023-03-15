<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsSignPmLeadToSalesOpties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_opties', function (Blueprint $table) {
            $table->foreignId('sign_pmLead')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_opties', function (Blueprint $table) {
            $table->dropForeign(['sign_pmLead']);
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsSalesOrdersToWodlists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wodlists', function (Blueprint $table) {
            $table->foreignId('salesorder_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wodlists', function (Blueprint $table) {
            $table->dropForeign(['salesorder_id']);
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsSalesOptiesToWodlists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wodlists', function (Blueprint $table) {
            $table->foreignId('salesopty_id')->nullable();
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
            $table->dropForeign(['salesopty_id']);
        });
    }
}

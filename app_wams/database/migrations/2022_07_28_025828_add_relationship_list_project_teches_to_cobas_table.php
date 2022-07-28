<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipListProjectTechesToCobasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('list_project_teches', function (Blueprint $table) {
            $table->foreignId('cobas_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('list_project_teches', function (Blueprint $table) {
            $table->dropForeign(['cobas_id']);
        });
    }
}

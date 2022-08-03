<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsSignAmSalesIdToListProjectAdmins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('list_project_admins', function (Blueprint $table) {
            $table->foreignId('signAmSales_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('list_project_admins', function (Blueprint $table) {
            $table->dropForeign(['signAmSales_id']);
        });
    }
}

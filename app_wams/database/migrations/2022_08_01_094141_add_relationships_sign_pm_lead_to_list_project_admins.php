<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsSignPmLeadToListProjectAdmins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('list_project_admins', function (Blueprint $table) {
            $table->foreignId('signPm_lead');
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
            $table->dropForeign(['signPm_lead']);
        });
    }
}

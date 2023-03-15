<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsPmIdToHistoryAdmins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('history_admins', function (Blueprint $table) {
            $table->foreignId('sign_Pm_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('history_admins', function (Blueprint $table) {
            $table->dropForeign(['sign_Pm_id']);
        });
    }
}

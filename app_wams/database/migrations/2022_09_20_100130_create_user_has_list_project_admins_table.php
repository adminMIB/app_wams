<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHasListProjectAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_list_project_admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id_technikal")->nullable();
            $table->foreignId("user_id_pm")->nullable();
            $table->foreignId("user_id_am")->nullable();
            $table->foreignId("ListProjectAdmin_id")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_has_list_project_admins');
    }
}

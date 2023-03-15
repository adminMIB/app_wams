<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpptyProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oppty_projects', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('ID_opptyproject');
            $table->string('nama_project');
            $table->string('pic_bussiness_channel');
            $table->string('client');
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
        Schema::dropIfExists('oppty_projects');
    }
}

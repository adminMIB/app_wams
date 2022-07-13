<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('create_weeklies', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('project_name');
            $table->string('uraian_job');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status_job');
            $table->string('note');
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
        Schema::dropIfExists('create_weeklies');
    }
};

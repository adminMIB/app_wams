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
        Schema::create('view_weekly_reports', function (Blueprint $table) {
            $table->id();
            $table->string("nama_client");
            $table->string("nama_project");
            $table->string("uraian_pekerjaan");
            $table->string("date");
            $table->string("status");
            $table->string("note");
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
        Schema::dropIfExists('view_weekly_reports');
    }
};

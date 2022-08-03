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
        Schema::create('list_project_teches', function (Blueprint $table) {
            $table->id();
            $table->string("institusi");
            $table->string("project");
            $table->string("hps");
            $table->string("nama_sales");
            $table->string("jenis_dokumen");
            $table->string("upload_dokumen");
            $table->string("sign_pm")->nullable();
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
        Schema::dropIfExists('list_project_teches');
    }
};

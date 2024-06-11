<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectMakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_makers', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->date('tanggal');
            $table->string('jenis_transaksi')->nullable();
            $table->string('nama_tujuan');
            $table->bigInteger('nominal')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('project_makers');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePicDistributorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pic_distributors', function (Blueprint $table) {
            $table->id();
            $table->string('nama_disti');
            $table->string('pic_disti');
            $table->string('jabatan_pic');
            $table->string('email_pic');
            $table->string('nomor_hp');
            $table->string('pengajuan_cl');
            $table->bigInteger('jumlah_cl');
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
        Schema::dropIfExists('pic_distributors');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('create_banks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bank');
            $table->string('alamat');
            $table->string('pic_bank');
            $table->string('email_pic_bank');
            $table->string('hp_pic_bank');
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
        Schema::dropIfExists('create_banks');
    }
}

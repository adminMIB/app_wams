<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik')->unique();
            $table->date('joined');
            $table->string('name');
            $table->string('from_institute');
            $table->string('status');
            $table->char('gender', 1)->comment('L: male, P: female');
            $table->string('skills');
            $table->string('address');
            $table->date('date_birth');
            $table->string('religion', 20);
            $table->integer('phone');
            $table->string('email')->unique();
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
        Schema::dropIfExists('hrds');
    }
}

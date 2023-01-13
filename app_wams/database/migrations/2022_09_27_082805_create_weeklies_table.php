<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeekliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weeklies', function (Blueprint $table) {
            $table->id();
            $table->string('job_essay');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status');
            $table->string('note');
            $table->string('name_technikal')->nullable();
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
        Schema::dropIfExists('weeklies');
    }
}

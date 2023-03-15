<?php

use Database\Seeders\ElearningDeatailSeeders;
use Database\Seeders\ElearningSeeders;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateElearnindDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elearnind_details', function (Blueprint $table) {
            $table->id();
            $table->string('produk',50)->nullable();
            $table->string('principle',50)->nullable();;
            $table->string('deskripsi',500)->nullable();;
            $table->string('upload')->nullable();;
            $table->timestamps();
        });
        Artisan::call('db:seed', [
            '--class' => ElearningDeatailSeeders::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('elearnind_details');
    }
}

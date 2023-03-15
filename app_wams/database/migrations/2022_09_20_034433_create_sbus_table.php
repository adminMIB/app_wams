<?php

use Database\Seeders\SbuSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateSbusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sbus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('PicSales')->nullable();
            $table->timestamps();
        });
        Artisan::call('db:seed', [
            '--class' => SbuSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sbus');
    }
}

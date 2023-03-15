<?php

use Database\Seeders\DistributorSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateDistributorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributors', function (Blueprint $table) {
            $table->id();
            $table->string('distributor');
            $table->string('alamat_disti')->nullable();
            $table->string('email')->nullable();
            $table->string('no_telp')->nullable();
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => DistributorSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distributors');
    }
}

<?php

use Database\Seeders\ProgressStatusSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateProgressStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('level')->nullable();
            $table->timestamps();
        });
        Artisan::call('db:seed', [
            '--class' => ProgressStatusSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progress_statuses');
    }
}

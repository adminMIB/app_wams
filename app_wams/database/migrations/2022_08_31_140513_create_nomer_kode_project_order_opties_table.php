<?php

use Database\Seeders\ElearningDeatailSeeders;
use Database\Seeders\ElearningSeeders;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateNomerKodeProjectOrderOptiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomer_kode_project_order_opties', function (Blueprint $table) {
            $table->id();
            $table->string("arr2");
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => ElearningSeeders::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nomer_kode_project_order_opties');
    }
}

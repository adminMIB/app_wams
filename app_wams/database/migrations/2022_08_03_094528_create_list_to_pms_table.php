<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListToPmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_to_pms', function (Blueprint $table) {
            $table->id();
            $table->string("no_sales");
            $table->string("tgl_sales");
            $table->string("kode_project");
            $table->string("nama_sales");
            $table->string("nama_institusi");
            $table->string("nama_project");
            $table->string("quantity")->nullable();
            $table->string("hps");
            $table->string("nama_pmlead")->nullable();
            $table->string("sign_pm");
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
        Schema::dropIfExists('list_to_pms');
    }
}

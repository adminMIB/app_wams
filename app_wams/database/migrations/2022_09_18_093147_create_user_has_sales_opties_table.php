<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHasSalesOptiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_sales_opties', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id_technikal")->nullable();
            $table->foreignId("user_id_pm")->nullable();
            $table->string("model_type")->nullable();
            $table->foreignId("sales_opties_id")->nullable();
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
        Schema::dropIfExists('user_has_sales_opties');
    }
}

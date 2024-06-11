<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opties', function (Blueprint $table) {
            $table->id();
            $table->string('code_opty')->unique();
            $table->integer('customer_id');
            $table->string('project_name');
            $table->string('account_manager');
            $table->bigInteger('revenue_sales');
            $table->boolean('is_moved')->default(false);
            $table->string('file');
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
        Schema::dropIfExists('opties');
    }
}

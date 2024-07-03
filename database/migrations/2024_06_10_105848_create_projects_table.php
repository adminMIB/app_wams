<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('id_project')->unique();
            $table->integer('opty_id');
            $table->integer('principal_id')->nullable();
            $table->string('file')->nullable();
            $table->json('component')->nullable();
            $table->bigInteger('bmt')->nullable()->default(0);
            $table->bigInteger('end_user')->nullable()->default(0);
            $table->bigInteger('delivery')->nullable()->default(0);
            $table->bigInteger('wapu')->nullable()->default(0);
            $table->bigInteger('ca')->nullable()->default(0);
            $table->bigInteger('service')->nullable()->default(0);
            $table->bigInteger('subtotal')->nullable()->default(0);
            $table->bigInteger('bunga_admin')->nullable()->default(0);
            $table->bigInteger('biaya_admin')->nullable();
            $table->bigInteger('biaya_pengurangan')->nullable()->default(0);
            $table->bigInteger('total_final')->nullable()->default(0);
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
        Schema::dropIfExists('projects');
    }
}

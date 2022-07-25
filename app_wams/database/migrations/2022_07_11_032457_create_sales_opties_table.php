<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_opties', function (Blueprint $table) {
            $table->id();
            $table->string('NamaClient');
            $table->string('NamaProject');
            $table->string('Timeline');
            $table->date('Date');
            $table->integer('Angka');
            $table->string('Status')->comment('Tender', 'Menang', 'Kalah');
            $table->string('Note');
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
        Schema::dropIfExists('sales_opties');
    }
};

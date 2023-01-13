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
            $table->string('ID_project')->nullable();
            $table->string('no_opty');
            $table->integer('no_customer')->nullable();
            $table->string('NamaClient');
            $table->string('NamaProject');
            $table->string('Timeline');
            $table->date('Date');
            $table->string('Status');
            $table->string('distributor')->nullable();
            $table->string('pmo')->nullable();
            $table->string('sbu')->nullable();
            $table->string('presales')->nullable();
            $table->integer('estimated_amount')->nullable();
            $table->string('confidence_level')->nullable();
            $table->integer('contract_amount')->nullable();
            $table->string('Note')->nullable();
            $table->string('UploadDocument')->nullable();
            $table->string('name_user');
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

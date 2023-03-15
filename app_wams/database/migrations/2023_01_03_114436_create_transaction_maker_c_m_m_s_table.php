<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionMakerCMMSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_maker_c_m_m_s', function (Blueprint $table) {
            $table->id();
            $table->string('tgl_po');
            $table->string('nama_project');
            $table->string('nama_klien');
            $table->string('nama_eu');
            $table->string('nominal_po');
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
        Schema::dropIfExists('transaction_maker_c_m_m_s');
    }
}

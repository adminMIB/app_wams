<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionMakerDclsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_maker_dcls', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal_po');
            $table->string('nama_project');
            $table->string('nama_client');
            $table->string('nama_eu');
            $table->bigInteger('nominal_po');
            $table->string('nama_sbu');
            $table->string('nama_pic');
            $table->string('pic_business_channel');
            $table->string('file_po_client');
            $table->string('file_po_mib');
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
        Schema::dropIfExists('transaction_maker_dcls');
    }
}

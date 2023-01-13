<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionMakerReimbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_maker_reimbursements', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal_reimbursement');
            $table->string('nama_pic_reimbursement');
            $table->bigInteger('nominal_reimbursement');
            $table->string('pic_business_channel');
            $table->string('client');
            $table->string('pic_client');
            $table->string('file_kwitansi');
            $table->string('file_MoM');
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
        Schema::dropIfExists('transaction_maker_reimbursements');
    }
}

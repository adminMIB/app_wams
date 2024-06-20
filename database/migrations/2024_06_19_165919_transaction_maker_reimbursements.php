<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransactionMakerReimbursements extends Migration
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
            $table->string('tanggal_reimbursement')->nullable();
            $table->integer('nama_pic_reimbursement')->nullable();
            $table->bigInteger('nominal_reimbursement')->nullable();
            $table->string('pic_business_channel')->nullable();
            $table->string('client')->nullable();
            $table->string('pic_client')->nullable();
            $table->string('file_kwitansi')->nullable();
            $table->string('file_MoM')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('reimbursements_id');
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

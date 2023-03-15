<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionMakerRevCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_maker_rev_costs', function (Blueprint $table) {
            $table->id();
            $table->string("project_id");
            $table->string("nama_project");
            $table->string("nama_client");
            $table->string("pic_sales");
            $table->string("pic_business_channel");
            $table->bigInteger("penerimaan_project")->nullable();
            $table->string("tanggal_penerimaan")->nullable();
            $table->bigInteger("pengeluaran_project")->nullable();
            $table->string("tanggal_pengeluaran")->nullable();
            $table->string("keterangan")->nullable();
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
        Schema::dropIfExists('transaction_maker_rev_costs');
    }
}

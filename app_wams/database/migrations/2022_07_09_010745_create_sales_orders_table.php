<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->string('no_so');
            $table->string('kode_project')->nullable();
            $table->string('institusi');
            $table->string('project');
            $table->string('hps');
            $table->string('file_quotation');
            $table->string('file_po');
            $table->string('file_spk');
            $table->string('jenis_dok')->nullable();
            $table->string('file_dokumen')->nullable();
            $table->string('status')->default('Pending');
            $table->string('name_user')->nullable();
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
        Schema::dropIfExists('sales_orders');
    }
}

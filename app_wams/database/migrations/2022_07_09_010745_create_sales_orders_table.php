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
            $table->string('institusi');
            $table->string('project');
            $table->string('hps')->comment('Dok PO', 'Dok Penawaran', 'Dok BAST');
            $table->string('file_quotation');
            $table->string('file_po');
            $table->string('file_spk');
            $table->string('status')->comment('Approve', 'Reject')->nullable();
            $table->string('editor');
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

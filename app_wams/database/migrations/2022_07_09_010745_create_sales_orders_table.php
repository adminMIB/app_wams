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
            $table->string('kode_project');
            $table->integer('no_customer')->nullable();
            $table->string('institusi');
            $table->string('project');
            $table->string('tgl_so');
            $table->string('file_project')->nullable();
            $table->string('file_PHD');
            $table->string('file_SPSC');
            $table->string('file_PS');
            $table->string('note_for_file1')->nullable();
            $table->string('note_for_file2')->nullable();
            $table->string('note_for_file3')->nullable();
            $table->string('distributor');
            $table->string('principal');
            $table->string('pmo')->nullable();
            $table->string('presales')->nullable();
            $table->string('amsales')->nullable();
            $table->string('sbu')->nullable();
            $table->integer('estimated_amount')->nullable();
            $table->string('confidence_level')->nullable();
            $table->integer('contract_amount')->nullable();
            $table->string('status_project');
            $table->string('status')->default('Pending');
            $table->string('note')->nullable();
            $table->integer('total')->nullable();
            $table->integer('grandtotal')->nullable();
            $table->string('name_user');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('st_project')->nullable();
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

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
        Schema::create('upload_documents', function (Blueprint $table) {
            $table->id();
            $table->string('no_doc');
            $table->string('tgl_up');
            $table->string('institusi');
            $table->string('project');
            $table->string('jenis_doc')->comment('Dok PO', 'Dok Penawaran', 'Dok BAST');
            $table->string('up_doc');
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
        Schema::dropIfExists('upload_documents');
    }
};

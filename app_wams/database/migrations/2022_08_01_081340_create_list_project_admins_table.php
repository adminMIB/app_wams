<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListProjectAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_project_admins', function (Blueprint $table) {
            $table->id();
            $table->string('ID_project');
            $table->integer('ID_Customer');
            $table->string('NamaClient');
            $table->string('NamaProject');
            $table->date('Date');
            // $table->string('Angka');
            $table->string('distributor')->nullable();
            $table->string('principal')->nullable();
            $table->string('Status');
            $table->string('UploadDocument');
            $table->string('Note')->nullable();
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
        Schema::dropIfExists('list_project_admins');
    }
}

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
            $table->string('NamaClient');
            $table->string('NamaProject');
            $table->string('UploadDocument');
            $table->date('Date');
            $table->string('Angka');
            $table->string('Status')->comment('Tender', 'Menang', 'Kalah');
            $table->string('Note');
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

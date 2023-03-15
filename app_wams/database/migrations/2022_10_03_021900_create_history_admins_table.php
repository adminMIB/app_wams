<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_admins', function (Blueprint $table) {
            $table->id();
            $table->string('ID_project')->nullable();
            $table->string('ID_Customer');
            $table->string('NamaClient')->nullable();
            $table->string('NamaProject')->nullable();
            $table->date('Date')->nullable();
            // $table->string('Angka')->nullable();
            $table->string('distributor')->nullable();
            $table->string('principal')->nullable();
            $table->string('Status')->nullable();
            $table->string('UploadDocument')->nullable();
            $table->string('Note')->nullable()->nullable();
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
        Schema::dropIfExists('history_admins');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileToHrdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hrds', function (Blueprint $table) {
            $table->bigInteger('nik')->change();
            $table->string('phone', 14)->change();
            $table->string('npwp')->after('email');
            $table->string('employee_number')->after('email');
            $table->string('position')->after('email');
            $table->string('department')->after('email');
            $table->string('status_tk')->after('email');
            $table->date('start_contract')->after('email');
            $table->date('end_contract')->after('email');
            $table->string('no_emergency')->after('email');
            $table->string('file_ktp')->after('email');
            $table->string('file_izasah')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hrds', function (Blueprint $table) {
            $table->dropColumn('npwp');
            $table->dropColumn('employee_number');
            $table->dropColumn('position');
            $table->dropColumn('department');
            $table->dropColumn('status_tk');
            $table->dropColumn('start_contract');
            $table->dropColumn('end_contract');
            $table->dropColumn('no_emergency');
            $table->dropColumn('file_ktp');
            $table->dropColumn('file_izasah');
        });
    }
}

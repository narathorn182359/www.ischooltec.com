<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlfTimeattendanceStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alf_timeattendance_student', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code_student');
            $table->string('code_term');
            $table->string('code_school');
            $table->string('code_month');
            $table->string('code_status');
            $table->dateTime('date');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alf_timeattendance_student');
    }
}

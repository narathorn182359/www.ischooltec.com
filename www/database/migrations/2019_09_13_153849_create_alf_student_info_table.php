<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlfStudentInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alf_student_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('img_student')->default('/img/student/default-avatar.png');
            $table->string('student_code_id')->nullable();
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->string('lastname')->nullable();
            $table->string('degree')->nullable();
            $table->string('class')->nullable();
            $table->string('room')->nullable();
            $table->string('name_school')->nullable();
            $table->string('card_number')->nullable();
            $table->string('birthday')->nullable();
            $table->string('nationality')->nullable();
            $table->string('race')->nullable();
            $table->string('tel')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('father')->nullable();
            $table->string('father_tel')->nullable();
            $table->string('mom')->nullable();
            $table->string('mom_tel')->nullable();
            $table->string('consult')->nullable();
            $table->string('status')->nullable()->default('Y');
            $table->dateTime('created_by')->nullable();
            $table->dateTime('update_by')->nullable();
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
        Schema::dropIfExists('alf_student_info');
    }
}

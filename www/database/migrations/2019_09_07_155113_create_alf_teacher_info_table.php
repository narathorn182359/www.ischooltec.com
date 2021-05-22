<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlfTeacherInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alf_teacher_info', function (Blueprint $table) {
            $table->bigIncrements('id_teacher');
            $table->string('img')->default('/img/student/default-avatar.png');
            $table->string('username_id_tc')->nullable();
            $table->string('titel_teacher')->nullable();
            $table->string('name_teacher')->nullable();
            $table->string('lastname_teacher')->nullable();
            $table->string('phone_teacher')->nullable();
            $table->string('school_teacher')->nullable();
            $table->string('school_section')->nullable();
            $table->string('school_room')->nullable();
            $table->string('status')->nullable()->default('Y');
            $table->string('created_by')->nullable();
            $table->string('update_by')->nullable();
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
        Schema::dropIfExists('alf_teacher_info');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlfDegreeStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alf_degree_student', function (Blueprint $table) {
          
            $table->bigIncrements('id');
            $table->string('name_degree');
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
        Schema::dropIfExists('alf_degree_student');
    }
}

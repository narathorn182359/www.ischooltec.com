<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlfParentInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alf_parent_info', function (Blueprint $table) {
            $table->bigIncrements('id_parent');
            $table->string('username_id')->nullable();
            $table->string('titel_parent')->nullable();
            $table->string('name_parent')->nullable();
            $table->string('lastname_parent')->nullable();
            $table->string('phone_parent')->nullable();
            $table->string('school_parent')->nullable();
            $table->string('student_parent')->nullable();
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
        Schema::dropIfExists('alf_parent_info');
    }
}

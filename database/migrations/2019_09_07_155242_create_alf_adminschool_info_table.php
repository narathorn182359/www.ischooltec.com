<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlfAdminschoolInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alf_adminschool_info', function (Blueprint $table) {
            $table->bigIncrements('id_adminschool');
            $table->string('username_id')->nullable();
            $table->string('titel_adminschool')->nullable();
            $table->string('name_adminschool')->nullable();
            $table->string('lastname_adminschool')->nullable();
            $table->string('phone_adminschool')->nullable();
            $table->string('school_adminschool')->nullable();
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
        Schema::dropIfExists('alf_adminschool_info');
    }
}

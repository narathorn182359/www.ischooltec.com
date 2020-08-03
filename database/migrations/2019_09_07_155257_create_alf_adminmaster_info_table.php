<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlfAdminmasterInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alf_adminmaster_info', function (Blueprint $table) {
            $table->bigIncrements('id_adminmaster');
            $table->string('username_id')->nullable();
            $table->string('titel_adminmaster')->nullable();
            $table->string('name_adminmaster')->nullable();
            $table->string('lastname_adminmaster')->nullable();
            $table->string('phone_adminmaster')->nullable();
            $table->string('school_adminmaster')->nullable();
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
        Schema::dropIfExists('alf_adminmaster_info');
    }
}

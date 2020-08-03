<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlfRoleAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alf_role_auth', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('group_id')->nullable();
           
            $table->string('title')->nullable();
            $table->string('url')->nullable();
            $table->string('icon')->nullable();
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
        Schema::dropIfExists('alf_role_auth');
    }
}

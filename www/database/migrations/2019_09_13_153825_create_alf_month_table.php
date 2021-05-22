<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlfMonthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alf_month', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_month')->nullable();
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
        Schema::dropIfExists('alf_month');
    }
}

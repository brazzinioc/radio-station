<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSchedulesPrograms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules_programs', function (Blueprint $table) {
            $table->id();

            $table->time('hour_start');
            $table->time('hour_end');

            //Foreign keys
            $table->unsignedBigInteger('id_program');
            $table->unsignedBigInteger('id_schedule');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');

            $table->foreign('id_program')->references('id')->on('programs');
            $table->foreign('id_schedule')->references('id')->on('schedules');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules_programs');
    }
}

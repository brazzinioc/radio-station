<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRadioStations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radio_stations', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('website')->nullable();
            $table->string('email')->unique();
            $table->text('slogan')->nullable();
            $table->text('about')->nullable();
            $table->text('mission')->nullable();
            $table->text('vision')->nullable();
            $table->text('moral_principles')->nullable();

            //Foreign keys
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');

            $table->foreign('created_by')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('updated_by')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();

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
        Schema::dropIfExists('radio_stations');
    }
}

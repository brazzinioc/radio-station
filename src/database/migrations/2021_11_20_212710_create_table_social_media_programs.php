<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSocialMediaPrograms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_media_programs', function (Blueprint $table) {
            $table->id();

            $table->string('facebook', 255)->nullable();
            $table->string('twitter', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('youtube', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
            $table->string('tiktok', 255)->nullable();
            $table->string('whatsapp', 255)->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('mobile_phone', 100)->nullable();

            // Foreing Key
            $table->unsignedBigInteger('id_program');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');

            $table->foreign('id_program')->references('id')->on('programs');
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
        Schema::dropIfExists('social_media_programs');
    }
}

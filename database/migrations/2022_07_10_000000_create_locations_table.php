<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasTable('locations')) {
            return;
        }

        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('address');
            $table->string('display_phone_number');
            $table->string('contact_phone_number');
            $table->text('open_hours')->nullable();
            $table->double('lat');
            $table->double('lng');
            $table->string('place_id');
            $table->string('layout')->nullable();
            $table->unsignedInteger('footer_id')->nullable();
            $table->timestamps();

            $table->foreign('footer_id')->references('id')->on('footers');
        });
    }

    public function down()
    {
        Schema::dropIfExists('locations');
    }
};

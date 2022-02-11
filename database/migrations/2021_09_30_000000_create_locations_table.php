<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('address')->nullable();
            $table->string('display_phone_number')->nullable();
            $table->string('contact_phone_number')->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->string('place_id')->nullable();
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

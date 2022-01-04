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
            $table->string('store_name');
            $table->string('partner_name');
            $table->string('store_address');
            $table->string('store_display_phone_number');
            $table->string('store_contact_phone_number');
            $table->string('store_hours');
            $table->string('slug');
            $table->double('lat');
            $table->double('lng');
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

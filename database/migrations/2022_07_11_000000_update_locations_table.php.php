<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->boolean('indexable');
            $table->timestamp('published_at')->nullable();

            $table->string('address')->change()->nullable();
            $table->string('display_phone_number')->change()->nullable();
            $table->string('contact_phone_number')->change()->nullable();
            $table->double('lat')->change()->nullable();
            $table->double('lng')->change()->nullable();
            $table->string('place_id')->change()->nullable();
        });
    }

    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('indexable');
            $table->dropColumn('published_at');

            $table->string('address')->change()->nullable(false);
            $table->string('display_phone_number')->change()->nullable(false);
            $table->string('contact_phone_number')->change()->nullable(false);
            $table->double('lat')->change()->nullable(false);
            $table->double('lng')->change()->nullable(false);
            $table->string('place_id')->change()->nullable(false);
        });
    }
};

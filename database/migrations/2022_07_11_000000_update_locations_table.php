<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            // Add columns
            $table->boolean('indexable')->after('layout');
            $table->text('open_hours')->after('place_id')->nullable();
            $table->timestamp('published_at')->after('footer_id')->nullable();

            // Change to make nullable
            $table->string('address')->change()->nullable();
            $table->string('display_phone_number')->change()->nullable();
            $table->string('contact_phone_number')->change()->nullable();
            $table->string('place_id')->change()->nullable();
        });

        // Change to make nullable
        DB::statement('ALTER TABLE locations modify `lat` DOUBLE NULL');
        DB::statement('ALTER TABLE locations modify `lng` DOUBLE NULL');
    }

    public function down()
    {
        //
    }
};

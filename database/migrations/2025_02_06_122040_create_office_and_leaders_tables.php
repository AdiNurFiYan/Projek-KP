<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Combined table for about and office information
        Schema::create('office_information', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->string('office_photo_path')->nullable();  // Add nullable()
            $table->text('embed_map_code')->nullable();
            $table->string('address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Table for leader information
        Schema::create('leaders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('photo_path')->nullable();
            $table->year('period_start');
            $table->year('period_end');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('office_information');
        Schema::dropIfExists('leaders');
    }
};
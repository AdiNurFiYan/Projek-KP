<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void  
    {
        // Drop existing tables if they exist
        Schema::dropIfExists('leaders');
        Schema::dropIfExists('office_information');

        // Create office_information table
        Schema::create('office_information', function (Blueprint $table) {
            $table->id();
            $table->text('content')->nullable();
            $table->string('office_photo_path')->nullable();
            $table->text('embed_map_code')->nullable();
            $table->text('address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Create leaders table with period validation
        Schema::create('leaders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('photo_path')->nullable();
            $table->integer('period_start')->comment('Year between 1500-2500');
            $table->integer('period_end')->comment('Year between 1500-2500');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaders');
        Schema::dropIfExists('office_information');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void  
    {
        Schema::dropIfExists('leaders');

        Schema::create('leaders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('photo_path')->nullable();
            $table->integer('period_start');
            $table->integer('period_end');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaders');

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
};
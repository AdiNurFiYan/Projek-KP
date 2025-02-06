<?php

// database/migrations/2024_01_14_000003_create_kibs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kibs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kib_type_id')->constrained()->onDelete('cascade');
            $table->string('nama_dokumen');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kibs');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sekolahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('korwil_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('jenis', ['TK', 'SD', 'SMP'])->nullable();
            $table->string('nama');
            $table->string('kapsek');
            $table->string('npsn')->unique();
            $table->string('akreditasi');
            $table->string('kurikulum');
            $table->text('alamat');
            $table->string('status_tanah');
            $table->string('no_sertifikat');
            $table->text('denah')->nullable(); // Changed to text and nullable
            $table->json('foto');
            $table->string('laporan_asset')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sekolahs');
    }
};
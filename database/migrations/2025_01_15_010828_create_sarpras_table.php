<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sarpras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sekolah_id')->constrained()->onDelete('cascade'); // Menghapus unique untuk memungkinkan satu sekolah memiliki beberapa entri di masa depan
            $table->unsignedInteger('ruang_kelas')->default(0); // Menggunakan unsigned untuk nilai positif
            $table->unsignedInteger('ruang_perpus')->default(0);
            $table->unsignedInteger('ruang_lab')->default(0);
            $table->unsignedInteger('ruang_praktik')->default(0);
            $table->unsignedInteger('ruang_pimpinan')->default(0);
            $table->unsignedInteger('ruang_guru')->default(0);
            $table->unsignedInteger('ruang_ibadah')->default(0);
            $table->unsignedInteger('uks')->default(0);
            $table->unsignedInteger('toilet')->default(0);
            $table->unsignedInteger('gudang')->default(0);
            $table->unsignedInteger('sirkulasi')->default(0);
            $table->unsignedInteger('olahraga')->default(0);
            $table->unsignedInteger('tu')->default(0);
            $table->unsignedInteger('konseling')->default(0);
            $table->unsignedInteger('osis')->default(0);
            $table->unsignedInteger('bangunan')->default(0);
            $table->unsignedInteger('dinas')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sarpras');
    }
};

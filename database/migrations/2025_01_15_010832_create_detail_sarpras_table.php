<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('detail_sarpras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sarpras_id')->constrained()->onDelete('cascade');
            $table->enum('jenis_ruang', [
                'ruang_kelas', 'ruang_perpus', 'ruang_lab', 'ruang_praktik',
                'ruang_pimpinan', 'ruang_guru', 'ruang_ibadah', 'uks',
                'toilet', 'gudang', 'sirkulasi', 'olahraga', 'tu',
                'konseling', 'osis', 'bangunan', 'dinas'
            ]);
            $table->float('luas')->unsigned(); // Menggunakan unsigned untuk memastikan luas bernilai positif
            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Rusak Sedang', 'Rusak Berat']);
            $table->json('foto')->nullable(); // nullable untuk fleksibilitas
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_sarpras');
    }
};

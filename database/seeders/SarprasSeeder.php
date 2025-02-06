<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SarprasSeeder extends Seeder
{
    public function run()
    {
        $sarprases = [
            // TK Tunas Harapan Ambarawa
            [
                'sekolah_id' => 1,
                'ruang_kelas' => 4,
                'ruang_perpus' => 0,
                'ruang_lab' => 0,
                'ruang_praktik' => 0,
                'ruang_pimpinan' => 1,
                'ruang_guru' => 1,
                'ruang_ibadah' => 1,
                'uks' => 1,
                'toilet' => 5, // 2 siswa laki-laki, 2 siswa perempuan, 1 guru
                'gudang' => 1,
                'sirkulasi' => 1,
                'olahraga' => 1,
                'tu' => 0,
                'konseling' => 0,
                'osis' => 0,
                'bangunan' => 350,
                'dinas' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // TK Permata Hati Bancak
            [
                'sekolah_id' => 2,
                'ruang_kelas' => 3,
                'ruang_perpus' => 0,
                'ruang_lab' => 0,
                'ruang_praktik' => 0,
                'ruang_pimpinan' => 1,
                'ruang_guru' => 1,
                'ruang_ibadah' => 1,
                'uks' => 1,
                'toilet' => 3, // 1 siswa laki-laki, 1 siswa perempuan, 1 guru
                'gudang' => 1,
                'sirkulasi' => 1,
                'olahraga' => 1,
                'tu' => 0,
                'konseling' => 0,
                'osis' => 0,
                'bangunan' => 300,
                'dinas' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // SD Negeri 1 Ambarawa
            [
                'sekolah_id' => 5,
                'ruang_kelas' => 12,
                'ruang_perpus' => 1,
                'ruang_lab' => 1,
                'ruang_praktik' => 1,
                'ruang_pimpinan' => 1,
                'ruang_guru' => 1,
                'ruang_ibadah' => 1,
                'uks' => 1,
                'toilet' => 10, // 4 siswa laki-laki, 4 siswa perempuan, 2 guru
                'gudang' => 1,
                'sirkulasi' => 1,
                'olahraga' => 1,
                'tu' => 1,
                'konseling' => 1,
                'osis' => 0,
                'bangunan' => 1800,
                'dinas' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // SMP Negeri 1 Ambarawa
            [
                'sekolah_id' => 9,
                'ruang_kelas' => 24,
                'ruang_perpus' => 1,
                'ruang_lab' => 4, // IPA 2, Komputer 1, Bahasa 1
                'ruang_praktik' => 2,
                'ruang_pimpinan' => 1,
                'ruang_guru' => 1,
                'ruang_ibadah' => 1,
                'uks' => 1,
                'toilet' => 14, // 6 siswa laki-laki, 6 siswa perempuan, 2 guru
                'gudang' => 2,
                'sirkulasi' => 1,
                'olahraga' => 2, // lapangan basket dan voli
                'tu' => 1,
                'konseling' => 1,
                'osis' => 1,
                'bangunan' => 3500,
                'dinas' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($sarprases as $sarpras) {
            DB::table('sarpras')->insert($sarpras);
        }
    }
}
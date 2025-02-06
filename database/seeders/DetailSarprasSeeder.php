<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailSarprasSeeder extends Seeder
{
    public function run()
    {
        $detailSarprases = [
            // TK Tunas Harapan Ambarawa (sarpras_id: 1)
            [
                'sarpras_id' => 1,
                'jenis_ruang' => 'ruang_kelas',
                'luas' => 56,
                'kondisi' => 'Baik',
                'foto' => json_encode(['sarpras-photos/kelas-tk1-1.jpg', 'sarpras-photos/kelas-tk1-2.jpg']),
                'keterangan' => 'Ruang kelas A dengan kapasitas 20 siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sarpras_id' => 1,
                'jenis_ruang' => 'ruang_perpus',
                'luas' => 56,
                'kondisi' => 'Baik',
                'foto' => json_encode(['sarpras-photos/kelas-tk2-1.jpg', 'sarpras-photos/kelas-tk2-2.jpg']),
                'keterangan' => 'Ruang kelas B dengan kapasitas 20 siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sarpras_id' => 1,
                'jenis_ruang' => 'toilet',
                'luas' => 12,
                'kondisi' => 'Baik',
                'foto' => json_encode(['sarpras-photos/toilet-tk1.jpg']),
                'keterangan' => 'Toilet siswa laki-laki',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // SD Negeri 1 Ambarawa (sarpras_id: 3)
            [
                'sarpras_id' => 3,
                'jenis_ruang' => 'ruang_kelas',
                'luas' => 64,
                'kondisi' => 'Baik',
                'foto' => json_encode(['sarpras-photos/kelas-sd1-1.jpg', 'sarpras-photos/kelas-sd1-2.jpg']),
                'keterangan' => 'Ruang kelas 1A dengan kapasitas 32 siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sarpras_id' => 3,
                'jenis_ruang' => 'ruang_perpus',
                'luas' => 96,
                'kondisi' => 'Baik',
                'foto' => json_encode(['sarpras-photos/perpus-sd1-1.jpg', 'sarpras-photos/perpus-sd1-2.jpg']),
                'keterangan' => 'Perpustakaan dengan kapasitas 40 siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sarpras_id' => 3,
                'jenis_ruang' => 'ruang_lab',
                'luas' => 80,
                'kondisi' => 'Rusak Ringan',
                'foto' => json_encode(['sarpras-photos/lab-sd1-1.jpg', 'sarpras-photos/lab-sd1-2.jpg']),
                'keterangan' => 'Laboratorium IPA dengan beberapa peralatan yang perlu perbaikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // SMP Negeri 1 Ambarawa (sarpras_id: 4)
            [
                'sarpras_id' => 4,
                'jenis_ruang' => 'ruang_lab',
                'luas' => 120,
                'kondisi' => 'Baik',
                'foto' => json_encode(['sarpras-photos/lab-smp1-1.jpg', 'sarpras-photos/lab-smp1-2.jpg']),
                'keterangan' => 'Laboratorium komputer dengan 40 unit komputer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sarpras_id' => 4,
                'jenis_ruang' => 'ruang_ibadah',
                'luas' => 150,
                'kondisi' => 'Baik',
                'foto' => json_encode(['sarpras-photos/mushola-smp1-1.jpg', 'sarpras-photos/mushola-smp1-2.jpg']),
                'keterangan' => 'Mushola dengan kapasitas 100 jamaah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sarpras_id' => 4,
                'jenis_ruang' => 'olahraga',
                'luas' => 364,
                'kondisi' => 'Rusak Ringan',
                'foto' => json_encode(['sarpras-photos/lapangan-smp1-1.jpg', 'sarpras-photos/lapangan-smp1-2.jpg']),
                'keterangan' => 'Lapangan basket dengan beberapa kerusakan pada permukaan lapangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($detailSarprases as $detailSarpras) {
            DB::table('detail_sarpras')->insert($detailSarpras);
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SekolahSeeder extends Seeder
{
    public function run()
    {
        $sekolahs = [
            // TK Ambarawa
            [
                'korwil_id' => 1,
                'jenis' => 'TK',
                'nama' => 'TK Tunas Harapan Ambarawa',
                'kapsek' => 'Siti Nurjanah, S.Pd',
                'npsn' => '20101101',
                'akreditasi' => 'B',
                'kurikulum' => 'Kurikulum 2013 PAUD',
                'alamat' => 'Jl. Veteran No. 15, Ambarawa',
                'status_tanah' => 'Milik Yayasan',
                'no_sertifikat' => '01.01.01.01.1.01101',
                'denah' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.9076601413517!2d110.40593537574216!3d-7.136676270002147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70890023e971c1%3A0xcb5088256d4bdfd6!2sTK-%20SD%20ISRIATI%20MOENADI!5e0!3m2!1sid!2sid!4v1737333364401!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'foto' => json_encode(['depan' => 'tk_ambarawa1_depan.jpg', 'dalam' => 'tk_ambarawa1_dalam.jpg', 'halaman' => 'tk_ambarawa1_halaman.jpg']),
                'laporan_asset' => 'laporan_2024_tk_ambarawa1.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // TK Bancak
            [
                'korwil_id' => 1,
                'jenis' => 'TK',
                'nama' => 'TK Permata Hati Bancak',
                'kapsek' => 'Nur Aini, S.Pd',
                'npsn' => '20101201',
                'akreditasi' => 'B',
                'kurikulum' => 'Kurikulum 2013 PAUD',
                'alamat' => 'Jl. Pandanaran No. 10, Bancak',
                'status_tanah' => 'Milik Yayasan',
                'no_sertifikat' => '01.01.01.01.1.01201',
                'denah' => 'denah_tk_bancak1.jpg',
                'foto' => json_encode(['depan' => 'tk_bancak1_depan.jpg', 'dalam' => 'tk_bancak1_dalam.jpg', 'halaman' => 'tk_bancak1_halaman.jpg']),
                'laporan_asset' => 'laporan_2024_tk_bancak1.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // TK Bandungan
            [
                'korwil_id' => 1,
                'jenis' => 'TK',
                'nama' => 'TK Cahaya Bangsa Bandungan',
                'kapsek' => 'Ratna Dewi, S.Pd',
                'npsn' => '20101301',
                'akreditasi' => 'A',
                'kurikulum' => 'Kurikulum 2013 PAUD',
                'alamat' => 'Jl. Jendral Sudirman No. 20, Bandungan',
                'status_tanah' => 'Milik Yayasan',
                'no_sertifikat' => '01.01.01.01.1.01301',
                'denah' => 'denah_tk_bandungan1.jpg',
                'foto' => json_encode(['depan' => 'tk_bandungan1_depan.jpg', 'dalam' => 'tk_bandungan1_dalam.jpg', 'halaman' => 'tk_bandungan1_halaman.jpg']),
                'laporan_asset' => 'laporan_2024_tk_bandungan1.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // TK Bergas
            [
                'korwil_id' => 1,
                'jenis' => 'TK',
                'nama' => 'TK Cerdas Ceria Bergas',
                'kapsek' => 'Rina Sulistyowati, S.Pd',
                'npsn' => '20101401',
                'akreditasi' => 'B',
                'kurikulum' => 'Kurikulum 2013 PAUD',
                'alamat' => 'Jl. Kartini No. 12, Bergas',
                'status_tanah' => 'Milik Yayasan',
                'no_sertifikat' => '01.01.01.01.1.01401',
                'denah' => 'denah_tk_bergas1.jpg',
                'foto' => json_encode(['depan' => 'tk_bergas1_depan.jpg', 'dalam' => 'tk_bergas1_dalam.jpg', 'halaman' => 'tk_bergas1_halaman.jpg']),
                'laporan_asset' => 'laporan_2024_tk_bergas1.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // SD Ambarawa
            [
                'korwil_id' => 4,
                'jenis' => 'SD',
                'nama' => 'SD Negeri 1 Ambarawa',
                'kapsek' => 'Dr. Bambang Supriyanto, M.Pd',
                'npsn' => '20301501',
                'akreditasi' => 'A',
                'kurikulum' => 'Kurikulum Merdeka',
                'alamat' => 'Jl. Tentara Pelajar No. 1, Ambarawa',
                'status_tanah' => 'Milik Pemerintah',
                'no_sertifikat' => '03.01.01.01.1.01111',
                'denah' => 'denah_sd_ambarawa1.jpg',
                'foto' => json_encode(['depan' => 'sd_ambarawa1_depan.jpg', 'dalam' => 'sd_ambarawa1_dalam.jpg', 'halaman' => 'sd_ambarawa1_halaman.jpg']),
                'laporan_asset' => 'laporan_2024_sd_ambarawa1.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // SD Bancak
            [
                'korwil_id' => 5,
                'jenis' => 'SD',
                'nama' => 'SD Negeri 1 Bancak',
                'kapsek' => 'H. Surya Wijaya, M.Pd',
                'npsn' => '20301601',
                'akreditasi' => 'A',
                'kurikulum' => 'Kurikulum Merdeka',
                'alamat' => 'Jl. Pendidikan No. 1, Bancak',
                'status_tanah' => 'Milik Pemerintah',
                'no_sertifikat' => '03.01.01.01.1.01501',
                'denah' => 'denah_sd_bancak1.jpg',
                'foto' => json_encode(['depan' => 'sd_bancak1_depan.jpg', 'dalam' => 'sd_bancak1_dalam.jpg', 'halaman' => 'sd_bancak1_halaman.jpg']),
                'laporan_asset' => 'laporan_2024_sd_bancak1.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // SD Bandungan
            [
                'korwil_id' => 6,
                'jenis' => 'SD',
                'nama' => 'SD Negeri 1 Bandungan',
                'kapsek' => 'Dra. Rina Wulandari, M.Pd',
                'npsn' => '20301701',
                'akreditasi' => 'A',
                'kurikulum' => 'Kurikulum Merdeka',
                'alamat' => 'Jl. Ki Hajar Dewantara No. 1, Bandungan',
                'status_tanah' => 'Milik Pemerintah',
                'no_sertifikat' => '03.01.01.01.1.01601',
                'denah' => 'denah_sd_bandungan1.jpg',
                'foto' => json_encode(['depan' => 'sd_bandungan1_depan.jpg', 'dalam' => 'sd_bandungan1_dalam.jpg', 'halaman' => 'sd_bandungan1_halaman.jpg']),
                'laporan_asset' => 'laporan_2024_sd_bandungan1.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // SD Bergas
            [
                'korwil_id' => 7,
                'jenis' => 'SD',
                'nama' => 'SD Negeri 1 Bergas',
                'kapsek' => 'Drs. Hadi Santoso, M.Pd',
                'npsn' => '20301801',
                'akreditasi' => 'A',
                'kurikulum' => 'Kurikulum Merdeka',
                'alamat' => 'Jl. Pahlawan No. 1, Bergas',
                'status_tanah' => 'Milik Pemerintah',
                'no_sertifikat' => '03.01.01.01.1.01701',
                'denah' => 'denah_sd_bergas1.jpg',
                'foto' => json_encode(['depan' => 'sd_bergas1_depan.jpg', 'dalam' => 'sd_bergas1_dalam.jpg', 'halaman' => 'sd_bergas1_halaman.jpg']),
                'laporan_asset' => 'laporan_2024_sd_bergas1.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // SMP Ambarawa
            [
                'korwil_id' => 3,
                'jenis' => 'SMP',
                'nama' => 'SMP Negeri 1 Ambarawa',
                'kapsek' => 'Dr. Agus Widodo, M.Pd',
                'npsn' => '20201901',
                'akreditasi' => 'A',
                'kurikulum' => 'Kurikulum Merdeka',
                'alamat' => 'Jl. Kartini No. 1, Ambarawa',
                'status_tanah' => 'Milik Pemerintah',
                'no_sertifikat' => '02.01.01.01.1.01801',
                'denah' => 'denah_smp_ambarawa1.jpg',
                'foto' => json_encode(['depan' => 'smp_ambarawa1_depan.jpg', 'dalam' => 'smp_ambarawa1_dalam.jpg', 'halaman' => 'smp_ambarawa1_halaman.jpg']),
                'laporan_asset' => 'laporan_2024_smp_ambarawa1.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // SMP Bancak
            [
                'korwil_id' => 3,
                'jenis' => 'SMP',
                'nama' => 'SMP Negeri 1 Bancak',
                'kapsek' => 'Dr. Hendro Wibowo, M.Pd',
                'npsn' => '20201111',
                'akreditasi' => 'A',
                'kurikulum' => 'Kurikulum Merdeka',
                'alamat' => 'Jl. Diponegoro No. 1, Bancak',
                'status_tanah' => 'Milik Pemerintah',
                'no_sertifikat' => '02.01.01.01.1.01901',
                'denah' => 'denah_smp_bancak1.jpg',
                'foto' => json_encode(['depan' => 'smp_bancak1_depan.jpg', 'dalam' => 'smp_bancak1_dalam.jpg', 'halaman' => 'smp_bancak1_halaman.jpg']),
                'laporan_asset' => 'laporan_2024_smp_bancak1.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // SMP Bandungan
            [
                'korwil_id' => 3,
                'jenis' => 'SMP',
                'nama' => 'SMP Negeri 1 Bandungan',
                'kapsek' => 'Dr. Joko Santoso, M.Pd',
                'npsn' => '20201121',
                'akreditasi' => 'A',
                'kurikulum' => 'Kurikulum Merdeka',
                'alamat' => 'Jl. Ahmad Yani No. 1, Bandungan',
                'status_tanah' => 'Milik Pemerintah',
                'no_sertifikat' => '02.01.01.01.1.01121',
                'denah' => 'denah_smp_bandungan1.jpg',
                'foto' => json_encode(['depan' => 'smp_bandungan1_depan.jpg', 'dalam' => 'smp_bandungan1_dalam.jpg', 'halaman' => 'smp_bandungan1_halaman.jpg']),
                'laporan_asset' => 'laporan_2024_smp_bandungan1.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($sekolahs as $sekolah) {
            DB::table('sekolahs')->insert($sekolah);
        }
    }
}
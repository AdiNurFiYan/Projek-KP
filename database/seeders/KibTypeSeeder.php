<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KibTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kibTypes = [
            [
                'nama' => 'KIB A - Tanah',
                'deskripsi' => 'Kartu Inventaris Barang untuk mencatat dan mendata aset berupa tanah.',
                'gambar' => 'kib-a.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'KIB B - Peralatan dan Mesin',
                'deskripsi' => 'Kartu Inventaris Barang untuk mencatat dan mendata aset berupa peralatan dan mesin.',
                'gambar' => 'kib-b.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'KIB C - Gedung dan Bangunan',
                'deskripsi' => 'Kartu Inventaris Barang untuk mencatat dan mendata aset berupa gedung dan bangunan.',
                'gambar' => 'kib-c.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'KIB D - Jalan, Irigasi dan Jaringan',
                'deskripsi' => 'Kartu Inventaris Barang untuk mencatat dan mendata aset berupa jalan, irigasi, dan jaringan.',
                'gambar' => 'kib-d.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'KIB E - Aset Tetap Lainnya',
                'deskripsi' => 'Kartu Inventaris Barang untuk mencatat dan mendata aset tetap lainnya seperti buku, barang bercorak kesenian/kebudayaan, dan hewan.',
                'gambar' => 'kib-e.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'KIB F - Konstruksi dalam Pengerjaan',
                'deskripsi' => 'Kartu Inventaris Barang untuk mencatat dan mendata aset berupa konstruksi yang masih dalam proses pengerjaan.',
                'gambar' => 'kib-f.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('kib_types')->insert($kibTypes);
    }
}
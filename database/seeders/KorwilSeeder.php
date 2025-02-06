<?php

namespace Database\Seeders;

use App\Models\Korwil;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class KorwilSeeder extends Seeder
{
    public function run()
    {
        $korwils = [
            [
                'nama' => 'TK',
                'gambar' => 'korwil-images/TK.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'SD',
                'gambar' => 'korwil-images/SD.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'SMP',
                'gambar' => 'korwil-images/SMP.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'AMBARAWA',
                'gambar' => 'korwil-images/AMBARAWA.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'BANCAK',
                'gambar' => 'korwil-images/BANCAK.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'BANDUNGAN',
                'gambar' => 'korwil-images/BANDUNGAN.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'BERGAS',
                'gambar' => 'korwil-images/BERGAS.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'BANYUBIRU',
                'gambar' => 'korwil-images/BANYUBIRU.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'BAWEN',
                'gambar' => 'korwil-images/BAWEN.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'BRINGIN',
                'gambar' => 'korwil-images/TK.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'GETASAN',
                'gambar' => 'korwil-images/SD.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'JAMBU',
                'gambar' => 'korwil-images/SMP.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'KALIWUNGU',
                'gambar' => 'korwil-images/AMBARAWA.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'PABELAN',
                'gambar' => 'korwil-images/BANCAK.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'PRINGAPUS',
                'gambar' => 'korwil-images/BANDUNGAN.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'SUMOWONO',
                'gambar' => 'korwil-images/BERGAS.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'SURUH',
                'gambar' => 'korwil-images/BANYUBIRU.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'SUSUKAN',
                'gambar' => 'korwil-images/BAWEN.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'TENGARAN',
                'gambar' => 'korwil-images/BANDUNGAN.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'TUNTANG',
                'gambar' => 'korwil-images/BERGAS.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'UNGARAN BARAT',
                'gambar' => 'korwil-images/BANYUBIRU.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'UNGARAN TIMUR',
                'gambar' => 'korwil-images/BAWEN.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($korwils as $korwil) {
            Korwil::create($korwil);
        }
    }
}
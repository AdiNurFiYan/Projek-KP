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
            ['nama' => 'TK', 'gambar' => 'images/korwil/TK.jpg'],
            ['nama' => 'SD', 'gambar' => 'images/korwil/Logo SD - Sekolah Dasar.jpg'],
            ['nama' => 'SMP', 'gambar' => 'images/korwil/smp.jpg'],
            ['nama' => 'AMBARAWA', 'gambar' => 'images/korwil/ambarawa.jpeg'],
            ['nama' => 'BANCAK', 'gambar' => 'images/korwil/bancak.jpg'],
            ['nama' => 'BANDUNGAN', 'gambar' => 'images/korwil/bandungan.jpg'],
            ['nama' => 'BERGAS', 'gambar' => 'images/korwil/bergas.png'],
            ['nama' => 'BANYUBIRU', 'gambar' => 'images/korwil/banyubiru.jpeg'],
            ['nama' => 'BAWEN', 'gambar' => 'images/korwil/bawen.jpg'],
            ['nama' => 'BRINGIN', 'gambar' => 'images/korwil/bringin.png'],
            ['nama' => 'GETASAN', 'gambar' => 'images/korwil/getasan.jpeg'],
            ['nama' => 'JAMBU', 'gambar' => 'images/korwil/jambu.png'],
            ['nama' => 'KALIWUNGU', 'gambar' => 'images/korwil/kaliwungu.jpg'],
            ['nama' => 'PABELAN', 'gambar' => 'images/korwil/pabelan.jpg'],
            ['nama' => 'PRINGAPUS', 'gambar' => 'images/korwil/pringapus.jpg'],
            ['nama' => 'SUMOWONO', 'gambar' => 'images/korwil/sumowono.jpg'],
            ['nama' => 'SURUH', 'gambar' => 'images/korwil/suruh.jpg'],
            ['nama' => 'SUSUKAN', 'gambar' => 'images/korwil/susukan.png'],
            ['nama' => 'TENGARAN', 'gambar' => 'images/korwil/tengaran.png'],
            ['nama' => 'TUNTANG', 'gambar' => 'images/korwil/tuntang.jpg'],
            ['nama' => 'UNGARAN BARAT', 'gambar' => 'images/korwil/ungaran barat.jpg'],
            ['nama' => 'UNGARAN TIMUR', 'gambar' => 'images/korwil/ungaran timur.jpg'],
        ];

        foreach ($korwils as $korwil) {
            Korwil::create([
                'nama' => $korwil['nama'],
                'gambar' => $korwil['gambar'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

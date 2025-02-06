<?php

namespace Database\Seeders;

use App\Models\Kib;
use App\Models\KibType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class KibSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan direktori storage/app/public/documents ada
        Storage::disk('public')->makeDirectory('documents');

        // Ambil semua KibType yang ada
        $kibTypes = KibType::all();

        foreach ($kibTypes as $type) {
            // Buat 3 dokumen untuk setiap tipe KIB
            for ($i = 1; $i <= 3; $i++) {
                // Buat file dummy
                $fileName = "dokumen_kib_{$type->id}_{$i}.xlsx";
                $filePath = "documents/{$fileName}";
                
                // Buat file kosong di storage
                Storage::disk('public')->put($filePath, '');

                // Buat record di database
                Kib::create([
                    'kib_type_id' => $type->id,
                    'nama_dokumen' => "Dokumen KIB {$type->name} #{$i}",
                    'file_path' => $filePath,
                ]);
            }
        }
    }
}
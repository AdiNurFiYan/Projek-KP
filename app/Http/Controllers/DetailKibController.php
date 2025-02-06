<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Korwil;
use App\Models\Kib;
use App\Models\KibType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DetailKibController extends Controller
{
    public function downloadExcel(Kib $kib): BinaryFileResponse
    {
        try {
            if ($kib->file_path && Storage::disk('public')->exists($kib->file_path)) {
                return response()->download(Storage::disk('public')->path($kib->file_path));
            }

            return back()->with('error', 'File tidak ditemukan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
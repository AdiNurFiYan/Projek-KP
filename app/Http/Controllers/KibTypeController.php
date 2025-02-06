<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Korwil;
use App\Models\Kib;
use App\Models\KibType;
use Illuminate\Http\Request;

class KibTypeController extends Controller
{
    public function index()
    {
        // Mengambil semua data KibType beserta relasinya
        $kibTypes = KibType::with('detailKibs')->get();

        return view('pages.data-barang', compact('kibTypes'));
    }

    public function show(KibType $kibType)
{
    // Mengambil detail Kib berdasarkan tipe
    $kibs = $kibType->detailKibs;
    return view('pages.detail-kib', compact('kibType', 'kibs'));
}
}

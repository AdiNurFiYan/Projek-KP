<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    /**
     * Menampilkan detail sekolah beserta sarpras.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Validasi ID agar hanya menerima angka
        if (!is_numeric($id)) {
            abort(404, 'Data sekolah tidak ditemukan.');
        }

        // Ambil data sekolah beserta sarpras terkait menggunakan eager loading
        $sekolah = Sekolah::with('sarpras')->find($id);

        if (!$sekolah) {
            // Jika data sekolah tidak ditemukan, kembalikan halaman error
            abort(404, 'Data sekolah tidak ditemukan.');
        }

        return view('sekolah.detail', compact('sekolah'));
    }
}

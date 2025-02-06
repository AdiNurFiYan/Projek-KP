<?php

namespace App\Http\Controllers;

use App\Models\DetailSarpras;
use Illuminate\Http\Request;

class DetailSarprasController extends Controller
{
    public function showByType($sarpras_id, $jenis_ruang)
    {
        $detailSarpras = DetailSarpras::where('sarpras_id', $sarpras_id)
            ->where('jenis_ruang', $jenis_ruang)
            ->first();

        if (!$detailSarpras) {
            return back()->with('error', 'Data tidak ditemukan');
        }

        // Handle foto property
        try {
            // Jika foto adalah string JSON, decode ke array
            if (is_string($detailSarpras->foto)) {
                $detailSarpras->foto = json_decode($detailSarpras->foto, true);
            }
            
            // Jika foto null atau decode gagal, set array kosong
            if (is_null($detailSarpras->foto) || !is_array($detailSarpras->foto)) {
                $detailSarpras->foto = [];
            }
        } catch (\Exception $e) {
            // Jika terjadi error saat decode, set array kosong
            $detailSarpras->foto = [];
            
            // Optional: log error
            \Log::error('Error processing foto: ' . $e->getMessage());
        }

        return view('pages.detail-sarpras', [
            'detailSarpras' => $detailSarpras,
            'jenis_ruang' => $jenis_ruang
        ]);
    }
}
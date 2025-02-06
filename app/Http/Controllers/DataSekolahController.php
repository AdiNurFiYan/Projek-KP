<?php
namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Korwil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataSekolahController extends Controller
{
    public function index(Request $request, Korwil $korwil)
    {
        $query = Sekolah::query()->with('korwil');
    
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }
    
        // Tentukan jenis yang diizinkan berdasarkan korwil ID
        $jenis = match($korwil->id) {
            1 => 'TK',
            3 => 'SMP',
            default => 'SD'
        };
    
        // Filter berdasarkan korwil_id dan jenis yang diizinkan
        $query->where([
            ['korwil_id', $korwil->id],
            ['jenis', $jenis]
        ]);

        // Set title berdasarkan jenis sekolah
        $title = match($korwil->id) {
            1 => 'DAFTAR TK',
            3 => 'DAFTAR SMP',
            default => 'DAFTAR SD ' . $korwil->nama
        };
    
        $sekolahs = $query->paginate($request->get('per_page', 10))->withQueryString();
        $search = $request->search;
        
        return view('pages.list-sekolah', compact(
            'korwil', 
            'sekolahs', 
            'title', 
            'search', 
            'jenis'  // Menggunakan 'jenis' bukan 'allowedJenis'
        ));
    }

    public function show(Korwil $korwil, Sekolah $sekolah)
    {
        // Validasi jenis sekolah berdasarkan korwil ID
        $expectedJenis = match($korwil->id) {
            1 => 'TK',
            3 => 'SMP',
            default => 'SD'
        };

        // Cek apakah sekolah memiliki jenis yang sesuai dengan korwil
        if ($sekolah->jenis !== $expectedJenis || $sekolah->korwil_id !== $korwil->id) {
            abort(404, 'Data sekolah tidak ditemukan atau tidak sesuai dengan wilayah korwil.');
        }

        $search = request()->query('search');
        $perPage = request()->query('per_page', 10);

        // Query untuk mendapatkan daftar sekolah
        $sekolahs = Sekolah::where([
            ['korwil_id', $korwil->id],
            ['jenis', $expectedJenis]
        ])
        ->when($search, function ($query) use ($search) {
            return $query->where('nama', 'like', "%{$search}%");
        })
        ->paginate($perPage)
        ->withQueryString();

        $title = 'Data Sekolah ' . $sekolah->jenis . ' ' . $korwil->nama;
        $jenis = $expectedJenis; // Tambahkan ini untuk view

        return view('pages.sekolah-sarpras', compact(
            'korwil', 
            'sekolah', 
            'sekolahs', 
            'search', 
            'title',
            'jenis'
        ));
    }
}
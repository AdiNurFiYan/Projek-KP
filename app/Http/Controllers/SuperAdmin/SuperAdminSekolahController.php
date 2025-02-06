<?php
namespace App\Http\Controllers\SuperAdmin;

use App\Models\Korwil;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use App\Models\DetailSarpras;
use App\Services\ActivityLogger;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SuperAdminSekolahController extends Controller
{
    public function tingkatan()
    {
        $korwils = Korwil::whereIn('id', [1, 2, 3])->paginate(12);
        return view('superadmin.superadmin-tingkatan-sekolah', compact('korwils'));
    }
 
    public function index(Korwil $korwil)
    {
        Log::info('Korwil yang diterima:', [
            'id' => $korwil->id,
            'nama' => $korwil->nama,
            'sekolah_count' => $korwil->sekolahs()->count()
        ]);
        
        $sekolahs = $korwil->sekolahs()
            ->orderBy('nama', 'asc')
            ->paginate(12);
        
        Log::info('Hasil query sekolah:', [
            'total' => $sekolahs->total(),
            'data' => $sekolahs->items()
        ]);
            
        return view('superadmin.superadmin-data-sekolah', compact('korwil', 'sekolahs'));
    }
 
    public function create(Korwil $korwil)
    {
        try {
            DB::beginTransaction();
            
            $count = $korwil->sekolahs()->count() + 1;
            
            $sekolah = $korwil->sekolahs()->create([
                'nama' => "Sekolah Baru {$count}",
                'jenis' => null,
                'kapsek' => '-',
                'npsn' => 'NPSN-' . time(),
                'akreditasi' => '-',
                'kurikulum' => '-',
                'alamat' => '-', 
                'status_tanah' => '-',
                'no_sertifikat' => '-',
                'denah' => null,
                'foto' => [],
                'laporan_asset' => null
            ]);
    
            $sekolah->sarpras()->create([
                'ruang_kelas' => 0,
                'ruang_perpus' => 0,
                'ruang_lab' => 0,
                'ruang_praktik' => 0,
                'ruang_pimpinan' => 0,
                'ruang_guru' => 0,
                'ruang_ibadah' => 0,
                'uks' => 0,
                'toilet' => 0,
                'gudang' => 0,
                'sirkulasi' => 0,
                'olahraga' => 0,
                'tu' => 0,
                'konseling' => 0,
                'osis' => 0,
                'bangunan' => 0,
                'dinas' => 0
            ]);
 
            ActivityLogger::log('Tambah Data Sekolah', $sekolah->nama);
    
            DB::commit();
    
            return redirect()
                ->route('super-admin.sekolah.detail', ['sekolah' => $sekolah, 'jenis' => request()->jenis])
                ->with('success', 'Data sekolah baru berhasil ditambahkan. Silahkan lengkapi data sekolah.');
    
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in create method:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menambah sekolah baru: ' . $e->getMessage());
        }
    }
 
    public function destroy(Sekolah $sekolah)
    {
        try {
            DB::beginTransaction();
            
            $korwil = $sekolah->korwil;
            $nama_sekolah = $sekolah->nama;
 
            if ($sekolah->denah && $sekolah->denah !== '-') {
                Storage::disk('public')->delete($sekolah->denah);
            }
 
            if ($sekolah->laporan_asset) {
                Storage::disk('public')->delete($sekolah->laporan_asset);
            }
 
            if (is_array($sekolah->foto)) {
                foreach ($sekolah->foto as $photo) {
                    Storage::disk('public')->delete('foto/' . $photo);
                }
            }
 
            $sekolah->sarpras()->delete();
            $sekolah->delete();
 
            ActivityLogger::log('Hapus Data Sekolah', $nama_sekolah);
 
            DB::commit();
            
            return redirect()
                ->route('super-admin.sekolah.sarpras', ['korwil' => $korwil])
                ->with('success', 'Sekolah berhasil dihapus');
 
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in destroy method:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
 
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus sekolah');
        }
    }
 
    public function datasekolah()
    {
        try {
            $korwils = Korwil::whereNotIn('id', [1, 2, 3])
                ->orderBy('nama', 'asc')
                ->paginate(12);
        
            Log::info('Data Korwil Query Results:', [
                'total' => $korwils->total(),
                'current_page' => $korwils->currentPage(),
                'items_count' => count($korwils->items())
            ]);
        
            return view('superadmin.superadmin-data-sekolah', ['korwils' => $korwils]);
        
        } catch (\Exception $e) {
            Log::error('Error in datasekolah:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan dalam memuat data');
        }
    }
 
    public function update(Request $request, Sekolah $sekolah)
    {
        try {
            DB::beginTransaction();
 
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'jenis' => 'nullable|string|max:255',
                'kapsek' => 'required|string|max:255',
                'npsn' => 'required|string|max:255',
                'akreditasi' => 'required|string|max:255',
                'kurikulum' => 'required|string|max:255',
                'alamat' => 'required|string',
                'google_maps_embed' => 'nullable|string',
                'status_tanah' => 'required|string|max:255',
                'no_sertifikat' => 'required|string|max:255'
            ]);
            $oldData = $sekolah->only([
             'nama', 'jenis', 'kapsek', 'npsn', 'akreditasi',
             'kurikulum', 'alamat', 'status_tanah', 'no_sertifikat'
         ]);
 
            $sekolah->update($validated);
            
            ActivityLogger::log(
             'Update Data Sekolah',
             $sekolah->nama,
             [
                 'old' => $oldData,
                 'new' => $sekolah->only(array_keys($oldData))
             ]
         );
 
         DB::commit();
     } catch (\Exception $e) {
         DB::rollBack();
         throw $e;
         
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in update method:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
 
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data sekolah')
                ->withInput();
        }
    }
 
    public function show(Sekolah $sekolah)
    {
        try {
            $sekolah->load(['sarpras.detailSarpras' => function($query) {
                $query->orderBy('jenis_ruang');
            }]);
            
            Log::info('Data Sekolah:', [
                'sekolah_id' => $sekolah->id,
                'has_sarpras' => $sekolah->sarpras ? true : false,
                'detail_count' => $sekolah->sarpras ? $sekolah->sarpras->detailSarpras->count() : 0
            ]);
 
            $detailSarpras = $sekolah->sarpras ? $sekolah->sarpras->detailSarpras : collect();
            
            return view('superadmin.superadmin-tampilan-sarpras', [
                'sekolah' => $sekolah,
                'detailSarpras' => $detailSarpras
            ]);
 
        } catch (\Exception $e) {
            Log::error('Error in show method:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
 
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memuat data sarpras');
        }
    }
 }
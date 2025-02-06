<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use App\Models\DetailSarpras;
use App\Services\ActivityLogger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SuperAdminDetailSarprasController extends Controller
{
    public function show(Sekolah $sekolah)
    {
        try {
            if (!$sekolah) {
                return redirect()->back()->with('error', 'Data sekolah tidak ditemukan');
            }

            Log::info('Loading sekolah data:', [
                'sekolah_id' => $sekolah->id,
                'nama_sekolah' => $sekolah->nama
            ]);

            $sekolah->load(['sarpras.detailSarpras' => function($query) {
                $query->orderBy('jenis_ruang');
            }]);

            return view('superadmin.superadmin-detail-sarpras', [
                'sekolah' => $sekolah
            ]);

        } catch (\Exception $e) {
            Log::error('Error in show method:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data sekolah');
        }
    }

    public function showSarpras(Sekolah $sekolah)
    {
        try {
            if (!$sekolah) {
                return redirect()->back()->with('error', 'Data sekolah tidak ditemukan');
            }
    
            $sekolah->load(['sarpras.detailSarpras' => function($query) {
                $query->orderBy('jenis_ruang');
            }]);
            
            // Kelompokkan detailSarpras berdasarkan jenis_ruang
            $groupedSarpras = $sekolah->sarpras->detailSarpras->groupBy('jenis_ruang');
            
            return view('superadmin.superadmin-detail-data-sarpras', [
                'sekolah' => $sekolah,
                'groupedSarpras' => $groupedSarpras
            ]);
    
        } catch (\Exception $e) {
            Log::error('Error in showSarpras method:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data sarpras');
        }
    }

    public function showDetailSarpras(Sekolah $sekolah, DetailSarpras $detailSarpras)
    {
        try {
            if ($detailSarpras->sarpras && $detailSarpras->sarpras->sekolah_id !== $sekolah->id) {
                return redirect()->back()->with('error', 'Detail sarpras tidak ditemukan untuk sekolah ini');
            }

            $detailSarpras->load('sarpras');
            $detailSarpras->formatted_jenis_ruang = ucwords(str_replace('_', ' ', $detailSarpras->jenis_ruang));

            return view('superadmin.superadmin-tampilan-sarpras', [
                'sekolah' => $sekolah,
                'detailSarpras' => $detailSarpras
            ]);

        } catch (\Exception $e) {
            Log::error('Error in showDetailSarpras method:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat detail sarpras');
        }
    }

    public function updateDetailSarpras(Request $request, Sekolah $sekolah, DetailSarpras $detailSarpras)
    {
        try {
            DB::beginTransaction();
    
            // Validasi input
            $validated = $request->validate([
                'luas' => 'required|numeric|min:0',
                'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Sedang,Rusak Berat',
                'keterangan' => 'nullable|string|max:1000',
                'photos' => 'nullable|array|max:3',
                'photos.*' => [
                    'image',
                    'mimes:jpeg,png,jpg',
                    'max:512'
                ]
            ]);
    
            // Simpan data lama sebelum update
            $oldData = [
                'luas' => $detailSarpras->luas,
                'kondisi' => $detailSarpras->kondisi,
                'keterangan' => $detailSarpras->keterangan
            ];
    
            // Update data dasar
            $detailSarpras->update([
                'luas' => $validated['luas'],
                'kondisi' => $validated['kondisi'],
                'keterangan' => $validated['keterangan'] ?? null,
            ]);

            // Log perubahan data dasar
            ActivityLogger::log(
                'Update Detail Sarpras',
                "{$detailSarpras->jenis_ruang} di {$sekolah->nama}",
                [
                    'old' => $oldData,
                    'new' => $detailSarpras->only(['luas', 'kondisi', 'keterangan']),
                    'jenis_ruang' => $detailSarpras->jenis_ruang
                ]
            );
    
            // Handle foto upload jika ada
            if ($request->hasFile('photos')) {
                $existingPhotos = is_array($detailSarpras->foto) ? $detailSarpras->foto : [];
                
                if (count($request->file('photos')) + count($existingPhotos) > 3) {
                    throw new \Exception('Total foto tidak boleh lebih dari 3');
                }
    
                $uploadedPhotos = [];
                foreach ($request->file('photos') as $photo) {
                    $fileName = 'sarpras-' . uniqid() . '.' . $photo->getClientOriginalExtension();
                    $path = $photo->storeAs('sarpras-photos', $fileName, 'public');
                    
                    if (!$path) {
                        throw new \Exception('Gagal mengupload foto');
                    }
                    
                    $uploadedPhotos[] = $path;
                }
    
                // Gabung dan update
                $allPhotos = array_merge($existingPhotos, $uploadedPhotos);
                $detailSarpras->update(['foto' => $allPhotos]);

                // Log penambahan foto
                ActivityLogger::log(
                    'Tambah Foto Sarpras',
                    "Tambah foto {$detailSarpras->jenis_ruang} di {$sekolah->nama}",
                    [
                        'jumlah_foto_ditambahkan' => count($uploadedPhotos),
                        'total_foto' => count($allPhotos),
                        'jenis_ruang' => $detailSarpras->jenis_ruang
                    ]
                );
            }
    
            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil diperbarui');
    
        } catch (\Exception $e) {
            DB::rollBack();
            if (isset($uploadedPhotos)) {
                foreach ($uploadedPhotos as $photo) {
                    Storage::disk('public')->delete($photo);
                }
            }
    
            Log::error('Error updating detail sarpras:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function uploadPhotos(Request $request, Sekolah $sekolah, DetailSarpras $detailSarpras)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'photos' => 'required|array|max:3',
                'photos.*' => [
                    'required',
                    'image',
                    'mimes:jpeg,png,jpg',
                    'max:512'
                ]
            ]);

            $existingPhotos = is_array($detailSarpras->foto) ? $detailSarpras->foto : [];
            
            if (count($request->file('photos')) + count($existingPhotos) > 3) {
                throw new \Exception('Total foto tidak boleh lebih dari 3');
            }

            $uploadedPhotos = [];
            foreach ($request->file('photos') as $photo) {
                $fileName = 'sarpras-' . uniqid() . '.' . $photo->getClientOriginalExtension();
                $path = $photo->storeAs('sarpras-photos', $fileName, 'public');
                
                if (!$path) {
                    throw new \Exception('Gagal mengupload foto');
                }
                
                $uploadedPhotos[] = $path;
            }

            $allPhotos = array_merge($existingPhotos, $uploadedPhotos);
            $detailSarpras->update(['foto' => $allPhotos]);

            // Log aktivitas upload foto
            ActivityLogger::log(
                'Upload Foto Sarpras',
                "Upload foto {$detailSarpras->jenis_ruang} di {$sekolah->nama}",
                [
                    'jumlah_foto' => count($request->file('photos')),
                    'total_foto' => count($allPhotos),
                    'jenis_ruang' => $detailSarpras->jenis_ruang
                ]
            );

            DB::commit();
            return redirect()->back()->with('success', 'Foto berhasil diupload');

        } catch (\Exception $e) {
            DB::rollBack();
            
            if (isset($uploadedPhotos)) {
                foreach ($uploadedPhotos as $photo) {
                    Storage::disk('public')->delete($photo);
                }
            }

            Log::error('Error uploading photos:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_files' => $request->allFiles()
            ]);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deletePhoto(Request $request, Sekolah $sekolah, DetailSarpras $detailSarpras)
    {
        try {
            DB::beginTransaction();

            $photoIndex = $request->input('photo_index');
            $currentPhotos = $detailSarpras->foto ?? [];

            if (!isset($currentPhotos[$photoIndex])) {
                return response()->json(['error' => 'Foto tidak ditemukan'], 404);
            }

            $deletedPhoto = $currentPhotos[$photoIndex];
            
            // Hapus file fisik
            Storage::disk('public')->delete($currentPhotos[$photoIndex]);
            
            // Hapus dari array dan reindex
            unset($currentPhotos[$photoIndex]);
            $currentPhotos = array_values($currentPhotos);
            
            // Update database
            $detailSarpras->update(['foto' => $currentPhotos]);

            ActivityLogger::log(
                'Hapus Foto Sarpras',
                "Hapus foto {$detailSarpras->jenis_ruang} di {$sekolah->nama}",
                [
                    'deleted_photo' => $deletedPhoto,
                    'remaining_photos' => count($currentPhotos),
                    'jenis_ruang' => $detailSarpras->jenis_ruang
                ]
            );

            DB::commit();

            return response()->json([
                'message' => 'Foto berhasil dihapus',
                'remaining_photos' => $currentPhotos
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting photo:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'sekolah_id' => $sekolah->id,
                'detail_sarpras_id' => $detailSarpras->id,
                'photo_index' => $request->input('photo_index')
            ]);

            return response()->json(['error' => 'Terjadi kesalahan saat menghapus foto'], 500);
        }
    }

    public function store(Request $request, Sekolah $sekolah)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'jenis_ruang' => 'required|string|in:ruang_kelas,ruang_perpus,ruang_lab,ruang_praktik,ruang_pimpinan,ruang_guru,ruang_ibadah,uks,toilet,gudang,sirkulasi,olahraga,tu,konseling,osis,bangunan,dinas',
                'luas' => 'required|numeric|min:0',
                'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Sedang,Rusak Berat',
                'foto.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'keterangan' => 'nullable|string|max:1000'
            ]);

            if (!$sekolah->sarpras) {
                throw new \Exception('Data sarpras tidak ditemukan untuk sekolah ini');
            }

            $photoNames = [];
            if ($request->hasFile('foto')) {
                foreach ($request->file('foto') as $photo) {
                    $fileName = 'sarpras-' . uniqid() . '.' . $photo->getClientOriginalExtension();
                    $path = $photo->storeAs('sarpras-photos', $fileName, 'public');
                    
                    if (!$path) {
                        throw new \Exception('Gagal mengupload foto');
                    }
                    
                    $photoNames[] = $path;
                }
            }

            $detailSarpras = DetailSarpras::create([
                'sarpras_id' => $sekolah->sarpras->id,
                'jenis_ruang' => $validated['jenis_ruang'],
                'luas' => $validated['luas'],
                'kondisi' => $validated['kondisi'],
                'foto' => !empty($photoNames) ? json_encode($photoNames) : null,
                'keterangan' => $validated['keterangan'] ?? null,
            ]);

            $columnName = $validated['jenis_ruang'];
            $sekolah->sarpras->increment($columnName);

            // Log penambahan ruangan baru
            ActivityLogger::log(
                'Tambah Ruangan',
                "Tambah {$validated['jenis_ruang']} di {$sekolah->nama}",
                [
                    'jenis_ruang' => $validated['jenis_ruang'],
                    'luas' => $validated['luas'],
                    'kondisi' => $validated['kondisi'],
                    'jumlah_foto' => count($photoNames),
                    'keterangan' => $validated['keterangan'] ?? null
                ]
            );

            DB::commit();
            
            return redirect()
                ->route('super-admin.sekolah.detail-data-sarpras', $sekolah)
                ->with('success', 'Ruangan baru berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollBack();
            
            if (isset($photoNames)) {
                foreach ($photoNames as $photo) {
                    Storage::disk('public')->delete($photo);
                }
            }

            Log::error('Error creating detail sarpras:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'sekolah_id' => $sekolah->id,
                'request_data' => $request->except(['_token'])
            ]);

            return redirect()
                ->route('super-admin.sekolah.detail-data-sarpras', $sekolah)
                ->with('error', 'Terjadi kesalahan saat menambahkan ruangan')
                ->withInput();
        }
    }

    public function update(Request $request, Sekolah $sekolah)
    {
        try {
            DB::beginTransaction();

            // Validasi input
            $validated = $request->validate([
                'jenis' => 'required',
                'nama' => 'required',
                'kapsek' => 'required',
                'akreditasi' => 'required',
                'kurikulum' => 'required', 
                'npsn' => 'required',
                'alamat' => 'required'
            ]);

            // Simpan data lama
            $oldData = $sekolah->only([
                'jenis', 'nama', 'kapsek', 'akreditasi',
                'kurikulum', 'npsn', 'alamat'
            ]);

            // Update data
            $sekolah->update($validated);

            // Log perubahan data sekolah
            ActivityLogger::log(
                'Update Data Sekolah',
                "Update data {$sekolah->nama}",
                [
                    'old' => $oldData,
                    'new' => $sekolah->fresh()->only(array_keys($oldData))
                ]
            );

            DB::commit();
            
            return redirect()
                ->back()
                ->with('success', 'Data sekolah berhasil diperbarui');
                
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error updating sekolah:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data sekolah')
                ->withInput();
        }
    }
}
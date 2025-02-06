<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminFotoSekolahController extends Controller
{
    public function index(Sekolah $sekolah)
    {
        try {
            Log::info('FotoSekolah Method Called', [
                'sekolah_id' => $sekolah->id,
                'current_photos' => $sekolah->foto
            ]);
            
            return view('admin.admin-foto-sekolah', compact('sekolah'));
        } catch (\Exception $e) {
            Log::error('Error in index method:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat halaman foto sekolah');
        }
    }

    public function store(Request $request, Sekolah $sekolah)
    {
        try {
            DB::beginTransaction();

            Log::info('Store method called', [
                'request_data' => $request->all(),
                'school_id' => $sekolah->id
            ]);

            $request->validate([
                'foto.*' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $currentFotos = is_array($sekolah->foto) ? $sekolah->foto : [];
            $uploadedPhotos = [];
            
            if (!Storage::disk('public')->exists('foto')) {
                Storage::disk('public')->makeDirectory('foto');
            }
            
            foreach ($request->file('foto') as $photo) {
                try {
                    $fileName = time() . '_' . $photo->getClientOriginalName();
                    Log::info('Processing photo', ['filename' => $fileName]);

                    $path = $photo->storeAs('foto', $fileName, 'public');
                    
                    if ($path) {
                        $currentFotos[] = $fileName;
                        $uploadedPhotos[] = $fileName;
                        Log::info('Photo stored successfully', ['path' => $path]);
                    }
                } catch (\Exception $e) {
                    Log::error('Error storing photo', [
                        'error' => $e->getMessage(),
                        'filename' => $fileName ?? 'unknown'
                    ]);
                    continue;
                }
            }
            
            $sekolah->update(['foto' => array_values($currentFotos)]);

            // Log activity
            ActivityLogger::log(
                'Upload Foto Sekolah',
                "Upload foto di {$sekolah->nama}",
                [
                    'jumlah_foto_upload' => count($uploadedPhotos),
                    'nama_file' => $uploadedPhotos,
                    'total_foto_sekarang' => count($currentFotos)
                ]
            );

            DB::commit();

            Log::info('School photos updated successfully', [
                'school_id' => $sekolah->id,
                'photos' => $currentFotos
            ]);

            return redirect()
                ->route('admin.sekolah.foto-sekolah', $sekolah)
                ->with('success', 'Foto sekolah berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in store method:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat mengupload foto')
                ->withInput();
        }
    }

    public function destroy(Sekolah $sekolah, $filename)
    {
        try {
            DB::beginTransaction();

            Log::info('Attempting to delete photo', [
                'school_id' => $sekolah->id,
                'filename' => $filename
            ]);

            if (Storage::disk('public')->exists('foto/' . $filename)) {
                Storage::disk('public')->delete('foto/' . $filename);
                
                $currentPhotos = is_array($sekolah->foto) ? $sekolah->foto : [];
                $currentPhotos = array_values(array_filter($currentPhotos, function($photo) use ($filename) {
                    return $photo !== $filename;
                }));

                $sekolah->update(['foto' => $currentPhotos]);

                // Log activity
                ActivityLogger::log(
                    'Hapus Foto Sekolah',
                    "Hapus foto di {$sekolah->nama}",
                    [
                        'foto_dihapus' => $filename,
                        'sisa_foto' => count($currentPhotos)
                    ]
                );

                DB::commit();

                Log::info('Photo deleted successfully', ['filename' => $filename]);
                return redirect()->back()->with('success', 'Foto berhasil dihapus');
            }

            Log::warning('Photo file not found', ['filename' => $filename]);
            return redirect()->back()->with('error', 'File foto tidak ditemukan');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting photo:', [
                'error' => $e->getMessage(),
                'filename' => $filename
            ]);
            return redirect()->back()->with('error', 'Gagal menghapus foto');
        }
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminTanahDenahController extends Controller
{
    /**
     * Display the land and layout page
     */
    public function index(Sekolah $sekolah)
    {
        return view('admin.admin-tanah-dan-denah', compact('sekolah'));
    }

    /**
     * Update the land and layout information
     */
    public function update(Request $request, Sekolah $sekolah)
    {
        try {
            DB::beginTransaction();
    
            // Validate input
            $validated = $request->validate([
                'status_tanah' => 'required|string|max:255',
                'no_sertifikat' => 'required|string|max:255',
                'denah' => ['nullable', 'string', function ($attribute, $value, $fail) {
                    if ($value && !str_contains($value, '<iframe') && !str_contains($value, '</iframe>')) {
                        $fail('Format embed tidak valid. Pastikan menggunakan kode embed yang benar.');
                    }
                }]
            ]);

            // Get old data for logging
            $oldStatusTanah = $sekolah->status_tanah;
            $oldNoSertifikat = $sekolah->no_sertifikat;
            $oldDenah = $sekolah->denah;
    
            // Update all data at once
            $sekolah->update([
                'status_tanah' => $validated['status_tanah'],
                'no_sertifikat' => $validated['no_sertifikat'],
                'denah' => $validated['denah'] ?? null
            ]);

            // Log changes
            if ($oldStatusTanah !== $validated['status_tanah']) {
                ActivityLogger::log(
                    'Update Status Tanah', 
                    "Mengubah status tanah di {$sekolah->nama} dari '{$oldStatusTanah}' menjadi '{$validated['status_tanah']}'"
                );
            }

            if ($oldNoSertifikat !== $validated['no_sertifikat']) {
                ActivityLogger::log(
                    'Update No Sertifikat', 
                    "Mengubah nomor sertifikat di {$sekolah->nama} dari '{$oldNoSertifikat}' menjadi '{$validated['no_sertifikat']}'"
                );
            }

            if ($oldDenah !== ($validated['denah'] ?? null)) {
                $action = $oldDenah ? 'Memperbarui' : 'Menambahkan';
                ActivityLogger::log(
                    'Update Denah', 
                    "{$action} denah sekolah di {$sekolah->nama}"
                );
            }
    
            DB::commit();
            return redirect()
                ->route('admin.sekolah.tanah-denah', $sekolah)
                ->with('success', 'Data tanah dan denah berhasil diperbarui');
    
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in update method:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'sekolah_id' => $sekolah->id,
                'request_data' => $request->except(['_token'])
            ]);
    
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data tanah dan denah: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the layout (denah) from the school
     */
    public function removeDenah(Sekolah $sekolah)
    {
        try {
            DB::beginTransaction();

            if ($sekolah->denah) {
                $sekolah->update(['denah' => null]);
                
                ActivityLogger::log(
                    'Hapus Denah', 
                    "Menghapus denah sekolah di {$sekolah->nama}"
                );

                DB::commit();
                return redirect()
                    ->route('admin.sekolah.tanah-denah', $sekolah)
                    ->with('success', 'Denah sekolah berhasil dihapus');
            }

            return redirect()
                ->route('admin.sekolah.tanah-denah', $sekolah)
                ->with('info', 'Tidak ada denah yang perlu dihapus');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error removing denah:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'sekolah_id' => $sekolah->id
            ]);

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus denah: ' . $e->getMessage());
        }
    }
}
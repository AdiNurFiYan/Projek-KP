<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminLaporanAsetController extends Controller
{
    public function index(Sekolah $sekolah)
    {
        return view('admin.admin-laporan-aset', compact('sekolah'));
    }

    public function store(Request $request, Sekolah $sekolah)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'laporan_asset' => 'required|file|mimes:xlsx,xls,pdf|max:5120', // 5120 KB = 5 MB
                'custom_filename' => 'nullable|string|max:255'
            ]);

            if ($request->hasFile('laporan_asset')) {
                // Get old file info for logging
                $oldFile = $sekolah->laporan_asset;

                // Delete old file if exists
                if ($oldFile) {
                    Storage::disk('public')->delete($oldFile);
                }

                $file = $request->file('laporan_asset');
                $extension = $file->getClientOriginalExtension();
                
                // Generate filename
                if ($request->filled('custom_filename')) {
                    // Clean filename and ensure it has the correct extension
                    $filename = str_replace(['/', '\\'], '_', $request->custom_filename);
                    $filename = preg_replace('/\.' . $extension . '$/', '', $filename); // Remove extension if present
                    $filename = $filename . '.' . $extension;
                } else {
                    $filename = time() . '_' . $file->getClientOriginalName();
                }

                // Store new file with custom name
                $path = $file->storeAs('laporan_asset', $filename, 'public');
                $sekolah->update(['laporan_asset' => $path]);

                // Log activity
                ActivityLogger::log(
                    'Upload Laporan Aset',
                    "Upload laporan aset di {$sekolah->nama}",
                    [
                        'nama_file_baru' => $filename,
                        'nama_file_asli' => $file->getClientOriginalName(),
                        'nama_file_lama' => $oldFile ? basename($oldFile) : null,
                        'ukuran_file' => $file->getSize(),
                        'tipe_file' => $file->getMimeType()
                    ]
                );

                DB::commit();

                return redirect()
                    ->route('admin.sekolah.laporan-aset', $sekolah)
                    ->with('success', 'Laporan aset berhasil diupload');
            }

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat mengupload file');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error uploading laporan:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat mengupload file')
                ->withInput();
        }
    }
}
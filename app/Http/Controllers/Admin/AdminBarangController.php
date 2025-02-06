<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KibType;
use App\Models\Kib;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AdminBarangController extends Controller
{
    public function index()
    {
        $kibTypes = KibType::paginate(9);
        return view('admin.admin-data-barang', compact('kibTypes'));
    }

    public function show(KibType $kibType)
    {
        $detailKibs = $kibType->detailKibs()->get();
        return view('admin.admin-detail-kib', compact('kibType', 'detailKibs'));
    }

    public function upload(Request $request, KibType $kibType)
    {
        $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'document' => [
                'required',
                'file',
                'mimes:pdf,xls,xlsx',
                'max:10240'
            ]
        ]);

        try {
            DB::beginTransaction();
            
            $file = $request->file('document');
            $extension = $file->getClientOriginalExtension();
            $fileName = Str::slug($request->nama_dokumen) . '-' . time() . '.' . $extension;
            
            $path = $file->storeAs('kib-documents', $fileName, 'public');
            
            $kib = Kib::create([
                'kib_type_id' => $kibType->id,
                'nama_dokumen' => $request->nama_dokumen,
                'file_path' => $path,
            ]);

            ActivityLogger::log('Upload KIB', "Upload dokumen {$request->nama_dokumen} pada KIB {$kibType->nama}");

            DB::commit();
            
            return redirect()
                ->back()
                ->with('success', 'File berhasil diupload');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error uploading KIB:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->with('error', 'Gagal mengupload file. Silakan coba lagi.');
        }
    }

    public function destroy(Kib $kib)
    {
        try {
            DB::beginTransaction();

            $namaKib = $kib->nama_dokumen;
            $kibType = $kib->kibType->nama;
            
            if(Storage::disk('public')->exists($kib->file_path)) {
                Storage::disk('public')->delete($kib->file_path);
            }

            $kib->delete();
            
            ActivityLogger::log('Hapus KIB', "Hapus dokumen {$namaKib} dari KIB {$kibType}");
            
            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'File berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting KIB:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus file. Silakan coba lagi.');
        }
    }
}
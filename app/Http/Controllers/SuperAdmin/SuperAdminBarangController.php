<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\KibType;
use App\Models\Kib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SuperAdminBarangController extends Controller
{
    public function index()
    {
        $kibTypes = KibType::paginate(9);
        return view('superadmin.superadmin-data-barang', compact('kibTypes'));
    }

    public function show(KibType $kibType)
    {
        $detailKibs = $kibType->detailKibs()->get();
        return view('superadmin.superadmin-detail-kib', compact('kibType', 'detailKibs'));
    }

    public function upload(Request $request, KibType $kibType)
    {
        $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'document' => 'required|file|mimes:pdf,xls,xlsx|max:10240',
        ]);

        try {
            $file = $request->file('document');
            $extension = $file->getClientOriginalExtension();
            $fileName = Str::slug($request->nama_dokumen) . '.' . $extension;
            
            $path = $file->storeAs('kib-documents', $fileName, 'public');
            
            Kib::create([
                'kib_type_id' => $kibType->id,
                'nama_dokumen' => $request->nama_dokumen,
                'file_path' => $path,
            ]);

            return redirect()
                ->back()
                ->with('success', 'File berhasil diupload.');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal mengupload file. ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Kib $kib)
    {
        try {
            // Delete file from storage first
            if (Storage::disk('public')->exists($kib->file_path)) {
                Storage::disk('public')->delete($kib->file_path);
            }
            
            $kib->delete();
            
            return redirect()
                ->back()
                ->with('success', 'File berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus file. ' . $e->getMessage());
        }
    }
}
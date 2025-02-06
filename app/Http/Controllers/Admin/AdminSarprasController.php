<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use App\Models\Sarpras;
use App\Models\Korwil;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminSarprasController extends Controller
{
   public function index(Korwil $korwil)
   {
       $sekolahs = $korwil->sekolahs()->paginate(10);
       return view('admin.admin-sekolah-sarpras', compact('korwil', 'sekolahs'));
   }

   public function show(Sekolah $sekolah)
   {
       try {
           $sarpras = $sekolah->sarpras ?? $sekolah->sarpras()->create([
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

           return view('admin.admin-data-sarpras', compact('sekolah', 'sarpras'));
       } catch (\Exception $e) {
           Log::error('Error in show method:', [
               'error' => $e->getMessage(),
               'trace' => $e->getTraceAsString()
           ]);
           
           return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data sarpras');
       }
   }

   public function update(Request $request, Sekolah $sekolah)
   {
       try {
           DB::beginTransaction();
   
           $validated = $request->validate([
               'ruang_kelas' => 'required|integer|min:0',
               'ruang_perpus' => 'required|integer|min:0',
               'ruang_lab' => 'required|integer|min:0',
               'ruang_praktik' => 'required|integer|min:0',
               'ruang_pimpinan' => 'required|integer|min:0',
               'ruang_guru' => 'required|integer|min:0',
               'ruang_ibadah' => 'required|integer|min:0',
               'uks' => 'required|integer|min:0',
               'toilet' => 'required|integer|min:0',
               'gudang' => 'required|integer|min:0',
               'sirkulasi' => 'required|integer|min:0',
               'olahraga' => 'required|integer|min:0',
               'tu' => 'required|integer|min:0',
               'konseling' => 'required|integer|min:0',
               'osis' => 'required|integer|min:0',
               'bangunan' => 'required|integer|min:0',
               'dinas' => 'required|integer|min:0'
           ]);
   
           // Get current sarpras data
           $currentSarpras = $sekolah->sarpras;
           
           // Capture old data before update
           $oldData = [];
           foreach ($validated as $field => $value) {
               $oldData[$field] = $currentSarpras ? $currentSarpras->$field : 0;
           }
           
           // Update sarpras
           $sarpras = $sekolah->sarpras()->updateOrCreate(
               ['sekolah_id' => $sekolah->id],
               $validated
           );
   
           // Log perubahan secara keseluruhan
           ActivityLogger::log(
               'Update Sarpras',
               "Update data sarpras {$sekolah->nama}",
               [
                   'sekolah_id' => $sekolah->id,
                   'sekolah_nama' => $sekolah->nama,
                   'old_data' => $oldData,
                   'new_data' => $validated,
                   'admin_id' => auth()->id(),
                   'timestamp' => now()
               ]
           );
   
           // Check each field and create/delete detail_sarpras accordingly
           foreach ($validated as $field => $value) {
               $currentValue = $oldData[$field];
               $changes = [];
               
               if ($currentValue == 0 && $value > 0) {
                   for ($i = 0; $i < $value; $i++) {
                       $sarpras->detailSarpras()->create([
                           'jenis_ruang' => $field,
                           'luas' => 0,
                           'kondisi' => 'Baik',
                           'keterangan' => null
                       ]);
                   }
                   $changes = [
                       'type' => 'addition',
                       'jenis_ruang' => $field,
                       'jumlah' => $value,
                       'previous' => 0
                   ];
                   ActivityLogger::log(
                       'Tambah Ruangan',
                       ucwords(str_replace('_', ' ', $field)) . " di {$sekolah->nama}",
                       $changes
                   );
               }
               elseif ($currentValue > 0 && $value == 0) {
                   $sarpras->detailSarpras()->where('jenis_ruang', $field)->delete();
                   $changes = [
                       'type' => 'removal',
                       'jenis_ruang' => $field,
                       'jumlah' => 0,
                       'previous' => $currentValue
                   ];
                   ActivityLogger::log(
                       'Hapus Ruangan', 
                       ucwords(str_replace('_', ' ', $field)) . " di {$sekolah->nama}",
                       $changes
                   );
               }
               elseif ($currentValue != $value && $value > 0) {
                   $currentCount = $sarpras->detailSarpras()->where('jenis_ruang', $field)->count();
                   
                   if ($value > $currentCount) {
                       for ($i = 0; $i < ($value - $currentCount); $i++) {
                           $sarpras->detailSarpras()->create([
                               'jenis_ruang' => $field,
                               'luas' => 0,
                               'kondisi' => 'Baik',
                               'keterangan' => null
                           ]);
                       }
                       $changes = [
                           'type' => 'increase',
                           'jenis_ruang' => $field,
                           'jumlah' => $value,
                           'previous' => $currentCount,
                           'difference' => $value - $currentCount
                       ];
                       ActivityLogger::log(
                           'Tambah Ruangan',
                           "Tambah " . ($value - $currentCount) . " " . ucwords(str_replace('_', ' ', $field)) . " di {$sekolah->nama}",
                           $changes
                       );
                   } elseif ($value < $currentCount) {
                       $sarpras->detailSarpras()
                           ->where('jenis_ruang', $field)
                           ->orderByDesc('created_at')
                           ->limit($currentCount - $value)
                           ->delete();
                       $changes = [
                           'type' => 'decrease',
                           'jenis_ruang' => $field,
                           'jumlah' => $value,
                           'previous' => $currentCount,
                           'difference' => $currentCount - $value
                       ];
                       ActivityLogger::log(
                           'Kurangi Ruangan',
                           "Kurangi " . ($currentCount - $value) . " " . ucwords(str_replace('_', ' ', $field)) . " di {$sekolah->nama}",
                           $changes
                       );
                   }
               }
           }
   
           DB::commit();
           return redirect()
               ->route('admin.sekolah.data-sarpras', $sekolah)
               ->with('success', 'Data sarpras berhasil diperbarui');
   
       } catch (\Exception $e) {
           DB::rollBack();
           Log::error('Error in update method:', [
               'error' => $e->getMessage(),
               'trace' => $e->getTraceAsString(),
               'sekolah_id' => $sekolah->id,
               'request_data' => $request->all()
           ]);
   
           return redirect()
               ->back()
               ->with('error', 'Terjadi kesalahan saat memperbarui data sarpras')
               ->withInput();
       }
   }

   public function addRoom(Request $request, Sekolah $sekolah)
   {
       try {
           $validated = $request->validate([
               'room_name' => 'required|string|max:255',
               'room_count' => 'required|integer|min:0'
           ]);

           $roomField = $this->getRoomField($validated['room_name']);
           
           if ($roomField) {
               $sekolah->sarpras()->increment($roomField, $validated['room_count']);
               ActivityLogger::log('Tambah Ruangan', "{$validated['room_name']} ({$validated['room_count']}) di {$sekolah->nama}");

               return redirect()
                   ->route('admin.sekolah.data-sarpras', $sekolah)
                   ->with('success', 'Ruangan berhasil ditambahkan');
           }

           return redirect()
               ->route('admin.sekolah.data-sarpras', $sekolah)
               ->with('error', 'Jenis ruangan tidak valid');

       } catch (\Exception $e) {
           Log::error('Error in addRoom method:', [
               'error' => $e->getMessage(),
               'trace' => $e->getTraceAsString()
           ]);

           return redirect()
               ->back()
               ->with('error', 'Terjadi kesalahan saat menambah ruangan')
               ->withInput();
       }
   }

   private function getRoomField($roomName)
   {
       $roomMap = [
           'Ruang Kelas' => 'ruang_kelas',
           'Ruang Perpustakaan' => 'ruang_perpus',
           'Ruang Laboratorium' => 'ruang_lab', 
           'Ruang Praktik' => 'ruang_praktik',
           'Ruang Pimpinan' => 'ruang_pimpinan',
           'Ruang Guru' => 'ruang_guru',
           'Ruang Ibadah' => 'ruang_ibadah',
           'UKS' => 'uks',
           'Toilet' => 'toilet',
           'Gudang' => 'gudang',
           'Sirkulasi' => 'sirkulasi',
           'Olahraga' => 'olahraga',
           'Tata Usaha' => 'tu',
           'Ruang Konseling' => 'konseling',
           'Ruang OSIS' => 'osis',
           'Bangunan' => 'bangunan',
           'Dinas' => 'dinas'
       ];

       return $roomMap[$roomName] ?? null;
   }
}
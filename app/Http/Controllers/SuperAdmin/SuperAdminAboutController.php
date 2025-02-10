<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Leader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class SuperAdminAboutController extends Controller
{
    /**
     * Display the about page with leaders information
     */
    public function index(): View
    {
        try {
            $about = About::active()->first();
            $leaders = Leader::orderByPeriod()->get();
            
            return view('superadmin.superadmin-about', compact('about', 'leaders'));
        } catch (\Exception $e) {
            Log::error('Error in super admin about index: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Update or create a new leader
     */
    public function updateLeader(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'photo' => 'nullable|image|max:2048',
                ...(Leader::periodRules()),
            ]);

            $leader = new Leader();

            if ($request->hasFile('photo')) {
                $leader->photo_path = $this->handleFileUpload(
                    $request->file('photo'),
                    'leader-photos'
                );
            }

            $leader->fill([
                'name' => $validated['name'],
                'position' => $validated['position'],
                'period_start' => $validated['period_start'],
                'period_end' => $validated['period_end'],
                'is_active' => true
            ]);
            $leader->save();

            DB::commit();
            return redirect()->back()->with('success', 'Leader berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating leader: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menambah leader.');
        }
    }

    /**
     * Delete a leader
     */
    public function deleteLeader(Leader $leader): JsonResponse
    {
        try {
            DB::beginTransaction();
            
            if ($leader->photo_path) {
                $this->deleteFile($leader->photo_path);
            }

            $leader->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Leader berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting leader: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus leader.'
            ], 500);
        }
    }

    /**
     * Edit existing leader
     */
    public function editLeader(Request $request, Leader $leader): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'photo' => 'nullable|image|max:2048',
                ...(Leader::periodRules()),
            ]);

            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($leader->photo_path) {
                    $this->deleteFile($leader->photo_path);
                }
                
                // Upload new photo
                $leader->photo_path = $this->handleFileUpload(
                    $request->file('photo'),
                    'leader-photos'
                );
            }

            $leader->update([
                'name' => $validated['name'],
                'position' => $validated['position'],
                'period_start' => $validated['period_start'],
                'period_end' => $validated['period_end']
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Leader berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error editing leader: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui leader.');
        }
    }

    /**
     * Get leader data
     */
    public function getLeader(Leader $leader): JsonResponse
    {
        try {
            return response()->json($leader);
        } catch (\Exception $e) {
            Log::error('Error fetching leader data: ' . $e->getMessage());
            return response()->json([
                'error' => 'Terjadi kesalahan saat mengambil data leader'
            ], 500);
        }
    }

    /**
     * Update about information
     */
    public function update(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'content' => 'required|string|max:10000',
                'office_photo' => 'nullable|image|max:2048',
                'embed_map_code' => 'nullable|string|max:1000',
                'address' => 'nullable|string|max:500'
            ]);

            $about = About::firstOrNew(['is_active' => true]);

            if ($request->hasFile('office_photo')) {
                // Delete old photo if exists
                if ($about->office_photo_path) {
                    $this->deleteFile($about->office_photo_path);
                }
                
                // Upload new photo
                $about->office_photo_path = $this->handleFileUpload(
                    $request->file('office_photo'),
                    'office-photos'
                );
            }

            $about->fill([
                'content' => $validated['content'],
                'embed_map_code' => $validated['embed_map_code'],
                'address' => $validated['address'],
                'is_active' => true
            ]);
            $about->save();

            DB::commit();
            return redirect()->back()->with('success', 'Informasi berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating about: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui informasi.');
        }
    }

    /**
     * Handle file upload
     */
    private function handleFileUpload($file, string $path): string
    {
        try {
            return $file->store($path, 'public');
        } catch (\Exception $e) {
            Log::error('Error uploading file: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete file from storage
     */
    private function deleteFile(string $path): void
    {
        try {
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting file: ' . $e->getMessage());
            // Don't throw the exception as this is not critical
        }
    }
}
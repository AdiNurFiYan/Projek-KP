<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Leader;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AboutController extends Controller
{
    public function index(): View
    {
        $about = About::active()->first();
        $leaders = Leader::active()->orderByPeriod()->get();
        
        return view('pages.about', compact('about', 'leaders'));
    }

    public function update(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'content' => ['required', 'string', 'max:10000'],
                'office_photo' => ['nullable', 'image', 'max:2048'],
                'embed_map_code' => ['nullable', 'string', 'max:1000'],
                'address' => ['nullable', 'string', 'max:500'],
            ]);

            $about = About::firstOrNew(['is_active' => true]);

            if ($request->hasFile('office_photo')) {
                if ($about->office_photo_path && Storage::disk('public')->exists($about->office_photo_path)) {
                    Storage::disk('public')->delete($about->office_photo_path);
                }
                $about->office_photo_path = $request->file('office_photo')
                    ->store('office', 'public');
            }

            $about->fill($validated);
            $about->save();

            DB::commit();
            return redirect()->route('about')
                ->with('success', 'Informasi berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating about: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui informasi.');
        }
    }

    public function getLeader($id)
    {
        try {
            $leader = Leader::findOrFail($id);
            return response()->json($leader);
        } catch (\Exception $e) {
            Log::error('Error fetching leader: ' . $e->getMessage());
            return response()->json(['error' => 'Leader tidak ditemukan'], 404);
        }
    }

    public function storeLeader(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'position' => ['required', 'string', 'max:255'],
                'photo' => ['required', 'image', 'max:2048'],
                ...(Leader::periodRules()),
            ]);

            $photoPath = $request->file('photo')->store('leaders', 'public');

            Leader::create([
                'name' => $validated['name'],
                'position' => $validated['position'],
                'photo_path' => $photoPath,
                'period_start' => $validated['period_start'],
                'period_end' => $validated['period_end']
            ]);

            DB::commit();
            return redirect()->route('about')->with('success', 'Leader berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error storing leader: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menambah leader.');
        }
    }

    public function updateLeader(Request $request, $id): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'position' => ['required', 'string', 'max:255'],
                'photo' => ['nullable', 'image', 'max:2048'],
                ...(Leader::periodRules()),
            ]);

            $leader = Leader::findOrFail($id);
            
            if ($request->hasFile('photo')) {
                if ($leader->photo_path && Storage::disk('public')->exists($leader->photo_path)) {
                    Storage::disk('public')->delete($leader->photo_path);
                }
                $leader->photo_path = $request->file('photo')->store('leaders', 'public');
            }

            $leader->update([
                'name' => $validated['name'],
                'position' => $validated['position'],
                'period_start' => $validated['period_start'],
                'period_end' => $validated['period_end']
            ]);

            DB::commit();
            return redirect()->route('about')->with('success', 'Leader berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating leader: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui leader.');
        }
    }

    public function deleteLeader($id): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $leader = Leader::findOrFail($id);
            
            if ($leader->photo_path && Storage::disk('public')->exists($leader->photo_path)) {
                Storage::disk('public')->delete($leader->photo_path);
            }
            
            $leader->delete();

            DB::commit();
            return redirect()->route('about')->with('success', 'Leader berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting leader: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus leader.');
        }
    }

    public function adminIndex(): View
    {
        return $this->index();
    }

    public function adminUpdate(Request $request): RedirectResponse
    {
        return $this->update($request);
    }

    public function adminStoreLeader(Request $request): RedirectResponse
    {
        return $this->storeLeader($request);
    }

    public function adminUpdateLeader(Request $request, $id): RedirectResponse
    {
        return $this->updateLeader($request, $id);
    }

    public function adminDeleteLeader($id): RedirectResponse
    {
        return $this->deleteLeader($id);
    }
}
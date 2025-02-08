<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Leader;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index(): View
    {
        $about = About::first();
        $leaders = Leader::orderBy('period_start', 'desc')->get();
        $leader = null; // Initialize empty leader variable
        
        return view('pages.about', compact('about', 'leaders', 'leader'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:10000'],
            'office_photo' => ['nullable', 'image', 'max:2048'],
            'embed_map_code' => ['nullable', 'string', 'max:1000'],
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        // Get current about record
        $about = About::first();
        if (!$about) {
            $about = new About();
        }

        // Handle office photo upload if provided
        if ($request->hasFile('office_photo')) {
            // Delete old photo if exists
            if ($about->office_photo_path && Storage::disk('public')->exists($about->office_photo_path)) {
                Storage::disk('public')->delete($about->office_photo_path);
            }
            $about->office_photo_path = $request->file('office_photo')->store('office', 'public');
        }

        // Update about information
        $about->content = $validated['content'];
        $about->embed_map_code = $validated['embed_map_code'];
        $about->address = $validated['address'];
        $about->save();

        return redirect()->route('about')->with('success', 'About information updated successfully.');
    }

    public function getLeader($id)
    {
        $leader = Leader::findOrFail($id);
        return response()->json($leader);
    }

    public function storeLeader(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'photo' => ['required', 'image', 'max:2048'],
            'period_start' => ['required', 'integer', 'min:1500', 'max:2500'],
            'period_end' => ['required', 'integer', 'min:1500', 'max:2500', 'gte:period_start'],
        ]);

        $photoPath = $request->file('photo')->store('leaders', 'public');

        Leader::create([
            'name' => $validated['name'],
            'position' => $validated['position'],
            'photo_path' => $photoPath,
            'period_start' => $validated['period_start'],
            'period_end' => $validated['period_end']
        ]);

        return redirect()->route('about')->with('success', 'Leader added successfully.');
    }

    public function updateLeader(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'period_start' => ['required', 'integer', 'min:1500', 'max:2500'],
            'period_end' => ['required', 'integer', 'min:1500', 'max:2500', 'gte:period_start'],
        ]);

        $leader = Leader::findOrFail($id);
        
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
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

        return redirect()->route('about')->with('success', 'Leader updated successfully.');
    }

    public function deleteLeader($id): RedirectResponse
    {
        $leader = Leader::findOrFail($id);
        
        // Delete photo if exists
        if ($leader->photo_path && Storage::disk('public')->exists($leader->photo_path)) {
            Storage::disk('public')->delete($leader->photo_path);
        }
        
        $leader->delete();

        return redirect()->route('about')->with('success', 'Leader deleted successfully.');
    }

    public function adminIndex(): View
    {
        $about = About::first();
        $leaders = Leader::orderBy('period_start', 'desc')->get();
        $leader = null; // Initialize empty leader variable
        
        return view('super-admin.about.index', compact('about', 'leaders', 'leader'));
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
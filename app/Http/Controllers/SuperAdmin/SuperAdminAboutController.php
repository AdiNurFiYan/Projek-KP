<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Leader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SuperAdminAboutController extends Controller
{
    public function index()
    {
        $about = About::where('is_active', true)->first();
        $leaders = Leader::orderBy('period_start', 'desc')->get(); // Get all leaders
        
        return view('superadmin.superadmin-about', compact('about', 'leaders'));
    }
    
    public function updateLeader(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'photo' => 'nullable|image|max:2048',
        'period_start' => 'required|integer|min:1500|max:2500',
        'period_end' => 'required|integer|min:1500|max:2500|gte:period_start'
    ]);

    $leader = new Leader();

    if ($request->hasFile('photo')) {
        $leader->photo_path = $request->file('photo')->store('leader-photos', 'public');
    }

    $leader->name = $request->name;
    $leader->position = $request->position;
    $leader->period_start = $request->period_start;
    $leader->period_end = $request->period_end;
    $leader->is_active = true;
    $leader->save();

    return redirect()->back()->with('success', 'Leader information added successfully');
}

public function deleteLeader(Leader $leader)
{
    try {
        // Start database transaction
        DB::beginTransaction();
        
        // Delete the photo if it exists
        if ($leader->photo_path) {
            try {
                if (Storage::disk('public')->exists($leader->photo_path)) {
                    Storage::disk('public')->delete($leader->photo_path);
                }
            } catch (\Exception $e) {
                // Log the error but continue with deletion
                \Log::error('Error deleting leader photo: ' . $e->getMessage());
            }
        }

        // Delete the leader record
        $leader->delete();
        
        // Commit transaction
        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Leader deleted successfully'
        ]);
    } catch (\Exception $e) {
        // Rollback transaction on error
        DB::rollBack();
        
        // Log the error
        \Log::error('Error deleting leader: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Error deleting leader. Please try again.'
        ], 500);
    }
}

public function editLeader(Request $request, Leader $leader)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'photo' => 'nullable|image|max:2048',
        'period_start' => 'required|integer|min:1500|max:2500',
        'period_end' => 'required|integer|min:1500|max:2500|gte:period_start'
    ]);

    try {
        if ($request->hasFile('photo')) {
            if ($leader->photo_path) {
                Storage::disk('public')->delete($leader->photo_path);
            }
            $leader->photo_path = $request->file('photo')->store('leader-photos', 'public');
        }

        $leader->name = $request->name;
        $leader->position = $request->position;
        $leader->period_start = $request->period_start;
        $leader->period_end = $request->period_end;
        $leader->save();

        return redirect()->back()->with('success', 'Leader information updated successfully');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error updating leader');
    }
}

public function getLeader(Leader $leader)
{
    try {
        return response()->json($leader);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error fetching leader data'], 500);
    }
}
public function update(Request $request)
{
    $request->validate([
        'content' => 'required|string|max:10000',
        'office_photo' => 'nullable|image|max:2048',
        'embed_map_code' => 'nullable|string',
        'address' => 'nullable|string'
    ]);

    $about = About::where('is_active', true)->first();
    if (!$about) {
        $about = new About();
    }

    if ($request->hasFile('office_photo')) {
        if ($about->office_photo_path) {
            Storage::disk('public')->delete($about->office_photo_path);
        }
        $about->office_photo_path = $request->file('office_photo')->store('office-photos', 'public');
    }

    $about->content = $request->content;
    $about->embed_map_code = $request->embed_map_code;
    $about->address = $request->address;
    $about->is_active = true;
    $about->save();

    return redirect()->back()->with('success', 'About information updated successfully');
}
}
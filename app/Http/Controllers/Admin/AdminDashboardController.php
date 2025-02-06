<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use App\Models\Kib;
use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'tkCount' => Sekolah::where('jenis', 'TK')->count(),
            'sdCount' => Sekolah::where('jenis', 'SD')->count(),
            'smpCount' => Sekolah::where('jenis', 'SMP')->count(),
            'kibCount' => Kib::count(),
        ];

        // Get only activities for the currently logged-in admin
        $activities = Activity::getRecentActivities('admin');

        return view('admin.dashboard', compact('stats', 'activities'));
    }
}
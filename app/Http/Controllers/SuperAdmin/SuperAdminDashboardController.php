<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Kib;
use App\Models\Sekolah;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuperAdminDashboardController extends Controller
{
    public function index()
{
    $stats = [
        'tkCount' => Sekolah::where('jenis', 'TK')->count(),
        'sdCount' => Sekolah::where('jenis', 'SD')->count(),
        'smpCount' => Sekolah::where('jenis', 'SMP')->count(),
        'kibCount' => Kib::count(),
    ];

    // Eager load admin relationship
    $activities = Activity::getRecentActivities('super_admin');

        return view('superadmin.dashboard', compact('stats', 'activities'));
    }
}
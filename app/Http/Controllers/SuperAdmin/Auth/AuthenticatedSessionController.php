<?php

namespace App\Http\Controllers\SuperAdmin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('superadmin.auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek apakah user adalah super admin
        $admin = Admin::where('email', $request->email)
                     ->where('role', 'super_admin')
                     ->first();

        if (!$admin) {
            return back()->withErrors([
                'email' => 'Only Super Admin can login here.',
            ])->onlyInput('email');
        }

        if (Auth::guard('super_admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('super-admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function destroy(Request $request)
    {
        Auth::guard('super_admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('super-admin.login');
    }
}
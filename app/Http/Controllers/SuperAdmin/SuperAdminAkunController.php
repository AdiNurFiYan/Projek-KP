<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminAkunController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('superadmin.superadmin-akun', compact('admins'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($admin) {
            return response()->json([
                'status' => 'success',
                'message' => 'Admin berhasil ditambahkan'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Gagal menambahkan admin'
        ]);
    }
    public function update(Request $request, Admin $admin)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email,' . $admin->id],
        'password' => ['nullable', 'string', 'min:8', 'confirmed'],
    ]);

    $admin->name = $request->name;
    $admin->email = $request->email;
    
    if ($request->filled('password')) {
        $admin->password = Hash::make($request->password);
    }

    if($admin->save()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Admin berhasil diperbarui'
        ]);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'Gagal memperbarui admin'
    ]);
}

public function destroy(Admin $admin)
{
    if($admin->delete()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Admin berhasil dihapus'
        ]);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'Gagal menghapus admin'
    ]);
}
}
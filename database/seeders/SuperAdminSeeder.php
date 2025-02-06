<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus baris ini karena kita menggunakan tabel admins
        // DB::table('super_admins')->truncate();

        Admin::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@test.com',
            'password' => Hash::make('password123'),
            'role' => 'super_admin'
        ]);
    }
}
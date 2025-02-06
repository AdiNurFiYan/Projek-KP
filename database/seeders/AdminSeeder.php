<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('admins')->truncate();

        // Admin::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@test.com',
        //     'password' => Hash::make('Password@123'),
        // ]);

        // Admin::create([
        //     'name' => 'Super Admin',
        //     'email' => 'superadmin@test.com',
        //     'password' => Hash::make('password123'),
        //     'role' => 'super_admin'
        // ]);

        // Create Admin
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);
    }
}
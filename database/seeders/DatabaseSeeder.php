<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Sarpras;
use App\Models\DetailSarpras;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key checks during seeding
        Schema::disableForeignKeyConstraints();

        // // Clear existing data to avoid duplication
        // User::truncate();
        // Sarpras::truncate();
        // DetailSarpras::truncate();

        // Create test user
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Run seeders in correct order
        $this->call([
            KorwilSeeder::class,
            SekolahSeeder::class,
            KibTypeSeeder::class,
            SarprasSeeder::class,      // Add SarprasSeeder before DetailSarprasSeeder
            DetailSarprasSeeder::class, // Add DetailSarprasSeeder before KibSeeder
            SuperAdminSeeder::class,
            
        
        ]);

        // Run KibSeeder after other seeders
        $this->call([
            KibSeeder::class,
        ]);

        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();
    }
}
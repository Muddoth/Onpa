<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class UserProfileSeeder extends Seeder
{
    public function run()
    {
        User::factory(5)->create()->each(function ($user) {
            // Create a profile linked to the user
            Profile::factory()->create([
                'user_id' => $user->id,
                'name' => $user->name, // optionally sync the name from user
            ]);
        });

        // Create a fixed test user
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password123'), // Use bcrypt to hash the password
        ]);

        // Create a profile linked to the test user
        Profile::factory()->create([
            'user_id' => $testUser->id,
            'name' => $testUser->name,
        ]);

        // Create the admin user
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('adminpassword123'), // You should use a secure password for admin
        ]);

        // Assign the admin role to the admin user
        $adminUser->assignRole('admin'); // This will assign the admin role 
    }
}

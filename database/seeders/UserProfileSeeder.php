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
    }
    // Add more users and profiles as needed...
}

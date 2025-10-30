<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tag;
use App\Models\Song;
use App\Models\Profile;

use Illuminate\Database\Seeder;
use Database\Seeders\SongSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SongSeeder::class);
        Song::factory(10)->create();
        Profile::factory(5)->create();
        Tag::factory(9)->create();
    }
}

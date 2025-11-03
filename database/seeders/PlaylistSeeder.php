<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Playlist;
use App\Models\Song;

class PlaylistSeeder extends Seeder
{
    public function run(): void
    {
        // Create some example playlists
        $playlists = [
            ['name' => 'Chill Vibes', 'description' => 'Relaxing and mellow tracks.'],
            ['name' => 'Workout Mix', 'description' => 'High-energy songs to stay pumped.'],
            ['name' => 'Throwbacks', 'description' => 'Old-school hits and classics.'],
        ];

        foreach ($playlists as $data) {
            $playlist = Playlist::create($data);

            // Attach random songs (assuming songs already seeded)
            $songIds = Song::inRandomOrder()->take(rand(3, 8))->pluck('id');
            $playlist->songs()->attach($songIds);
        }

        echo "Playlists seeded successfully!\n";
    }
}

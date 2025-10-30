<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Song;
use Faker\Factory as Faker;

class SongSeeder extends Seeder
{
    public function run(): void
    {
        $audioFolder = public_path('audio');
        $imageFolder = public_path('images/songs');
        $faker = Faker::create();

        // Scan and sort both folders by modification date
        $audioFiles = collect(scandir($audioFolder))
            ->filter(fn($f) => !in_array($f, ['.', '..']))
            ->map(fn($f) => $audioFolder . DIRECTORY_SEPARATOR . $f)
            ->sortBy(fn($f) => filemtime($f))
            ->values();

        $imageFiles = collect(scandir($imageFolder))
            ->filter(fn($f) => !in_array($f, ['.', '..']))
            ->map(fn($f) => $imageFolder . DIRECTORY_SEPARATOR . $f)
            ->sortBy(fn($f) => filemtime($f))
            ->values();

        $count = min($audioFiles->count(), $imageFiles->count());

        for ($i = 0; $i < $count; $i++) {
            $audioPath = $audioFiles[$i];
            $imagePath = $imageFiles[$i];
            $name = pathinfo(basename($audioPath), PATHINFO_FILENAME);

            Song::create([
                'name' => $name,
                'artist_name' => $faker->name(),
                'album' => $faker->words(2, true),
                'genre' => $faker->randomElement(['Pop', 'Rock', 'Hip Hop', 'Jazz', 'Classical', 'Electronic']),
                'file_path' => 'audio/' . basename($audioPath),
                'image_path' => 'images/songs/' . basename($imagePath),
            ]);
        }

        echo "$count songs seeded successfully!\n";
    }
}

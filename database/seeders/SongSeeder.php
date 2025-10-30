<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Song;
use Faker\Factory as Faker;

class SongSeeder extends Seeder
{
    public function run(): void
    {
        $folder = 'C:\Users\a\Desktop\LIB\ProgrammingProjects\PhpProjects\Onpa\public\audio';
        $faker = Faker::create();

        if (!is_dir($folder)) {
            echo "Folder not found: $folder\n";
            return;
        }

        $files = scandir($folder);

        // Filter out only files
        $files = array_filter($files, function ($file) use ($folder) {
            return !in_array($file, ['.', '..']) && is_file($folder . DIRECTORY_SEPARATOR . $file);
        });

        foreach ($files as $file) {
            $name = pathinfo($file, PATHINFO_FILENAME); // ← Get file name without extension

            Song::create([
                'name' => $name, // ← Added this line
                'artist_name' => $faker->name(),
                'album' => $faker->words(2, true),
                'genre' => $faker->randomElement(['Pop', 'Rock', 'Hip Hop', 'Jazz', 'Classical', 'Electronic']),
                'file_path' => 'audio/' . $file,
                'image_path' => $faker->imageurl(),
            ]);
        }

        echo count($files) . " songs seeded!\n";
    }
}

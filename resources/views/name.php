<?php

$folder = 'C:\\Users\\a\\Videos\\SnapDownloader';

if (!is_dir($folder)) {
    echo "❌ Folder not found: $folder\n";
    exit;
}

$files = scandir($folder);

// Filter out only real files
$files = array_filter($files, function($file) use ($folder) {
    return !in_array($file, ['.', '..']) && is_file($folder . DIRECTORY_SEPARATOR . $file);
});

if (empty($files)) {
    echo "⚠️  No files found in: $folder\n";
    exit;
}

echo "🎵 Found " . count($files) . " files:\n\n";

foreach ($files as $file) {
    $name = pathinfo($file, PATHINFO_FILENAME); // remove .mp3/.mp4 extensions
    $filePath = $folder . DIRECTORY_SEPARATOR . $file;
    
    echo "- Name: $name\n";
    echo "  Path: $filePath\n\n";
}

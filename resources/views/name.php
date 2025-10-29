<?php
$folder = 'C:\\Users\\a\\Videos\\SnapDownloader';

if (is_dir($folder)) {
    $files = scandir($folder);

    // Filter out '.' and '..'
    $files = array_filter($files, function($file) use ($folder) {
        return !in_array($file, ['.', '..']) && is_file($folder . DIRECTORY_SEPARATOR . $file);
    });

    header('Content-Type: text/plain');
    foreach ($files as $file) {
        echo $file . PHP_EOL;
    }
} else {
    echo "Folder not found: $folder";
}
?>

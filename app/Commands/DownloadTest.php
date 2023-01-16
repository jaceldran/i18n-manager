<?php

use App\Controllers\Api\Translations;

require getcwd() . '/boot/app.php';

$exportPaths = [
    Flight::env('EXPORT_JSON'),
    Flight::env('EXPORT_PHP'),
    Flight::env('EXPORT_CSV'),
];

$zipArchivePath = APP_PATH . '/.tmp/translations.zip';

@unlink($zipArchivePath);
$zipArchive = new ZipArchive;
if ($zipArchive->open($zipArchivePath, ZipArchive::CREATE) === true) {
    foreach ($exportPaths as $exportPath) {
        $scandir = $data[$exportPath] = Translations::scandir($exportPath);
        foreach ($scandir as $file) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $filepath = "{$exportPath}/$file";
            $entryname = "$extension/$file";
            $zipArchive->addFile($filepath, $entryname);
        }
    }
}

$zipArchive->close();

// print_r($zip);

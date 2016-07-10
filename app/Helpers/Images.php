<?php

namespace App\Helpers;

use App\Classes\Tile;

class Images {

    public static function getTextureLand($random = true) {
        return self::getRandomFile(Tile::TYPE_LAND);
    }

    // =========================================================================

    public static function getRandomFile($filePath) {
        $files = self::getFiles($filePath);
        $file = $files[array_rand($files)];

        if ($file === null) {
            die("Random image for `$filePath` failed with null");
        }

        return $file;
    }

    // =========================================================================

    private static function getFiles($dirName) {
        $dirPath = 'img/world/' . $dirName . '/';
        $files = array_diff(scandir(public_path($dirPath)), ['.', '..']);

        $outputFiles = [];
        foreach ($files as $fileName) {
            if (is_dir($dirPath . $fileName)) {
                continue;
            }

            $outputFiles[] = $dirPath . $fileName;
        }
        return $outputFiles;
    }

}

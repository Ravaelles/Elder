<?php

namespace App\Helpers;

class Nature {

    const GRASS_DIR = "/img/nature/grass/";
    const TREE_DIR = "/img/nature/tree/";
    const MISC_DIR = "/img/nature/misc/";

    private static $imageCounter = [];

    // =========================================================================

//    public static function grass() {
//        $imgName = self::GRASS_DIR . rand(1, self::NUM_OF_GRASS_IMAGES);
//        return self::image($imgName);
//    }
//
//    public static function tree() {
//        $imgName = self::TREE_DIR . rand(1, self::NUM_OF_TREE_IMAGES);
//        return self::image($imgName);
//    }
//
//    public static function misc() {
//        $imgName = self::MISC_DIR . rand(1, self::NUM_OF_MISC_IMAGES);
//        return self::image($imgName);
//    }
    // =========================================================================

    public static function grassImages() {
        return self::listOfImages(self::GRASS_DIR);
    }

    public static function treeImages() {
        return self::listOfImages(self::TREE_DIR);
    }

    public static function miscImages() {
        return self::listOfImages(self::MISC_DIR);
    }

    public static function listOfImages($basePath) {
        if (isset(self::$imageCounter[$basePath])) {
            $max = self::$imageCounter[$basePath];
        } else {
            $fi = new \FilesystemIterator(base_path() . "/public" . $basePath, \FilesystemIterator::SKIP_DOTS);
            $max = iterator_count($fi);
            self::$imageCounter[$basePath] = $max;
        }

        $images = [];
        for ($i = 1; $i <= $max; $i++) {
            $images[] = '"' . self::image($basePath . $i) . '"';
        }
        return implode(", ", $images);
    }

    // =========================================================================

    private static function image($imgName) {
        return "<img src='$imgName.png' />";
    }

}

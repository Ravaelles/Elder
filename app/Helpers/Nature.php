<?php

namespace App\Helpers;

class Nature {

    const GRASS_DIR = "/img/nature/grass/";
    const NUM_OF_GRASS_IMAGES = 1;
    const TREE_DIR = "/img/nature/tree/";
    const NUM_OF_TREE_IMAGES = 6;

    // =========================================================================

    public static function grass() {
        $imgName = self::GRASS_DIR . rand(1, self::NUM_OF_GRASS_IMAGES);
        return self::image($imgName);
    }

    public static function tree() {
        $imgName = self::TREE_DIR . rand(1, self::NUM_OF_TREE_IMAGES);
        return self::image($imgName);
    }

    // =========================================================================

    public static function grassImages() {
        return self::listOfImages(self::GRASS_DIR, self::NUM_OF_GRASS_IMAGES);
    }

    public static function treeImages() {
        return self::listOfImages(self::TREE_DIR, self::NUM_OF_TREE_IMAGES);
    }

    public static function listOfImages($basePath, $max) {
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

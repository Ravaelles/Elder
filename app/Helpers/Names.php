<?php

namespace App\Helpers;

class Names {

    private static $namesMale = null;
    private static $namesFemale = null;

    // =========================================================================

    public static function randomName($sex) {
        if ($sex === "F") {
            return self::randomFemale();
        } else {
            return self::randomMale();
        }
    }

    public static function randomMale() {
        return self::getMaleNames()[array_rand(self::getMaleNames())];
    }

    public static function randomFemale() {
        return self::getFemaleNames()[array_rand(self::getFemaleNames())];
    }

    // =========================================================================

    private static function getMaleNames() {
        if (empty(self::$namesMale)) {
            self::$namesMale = file(base_path() . "/resources/assets/names/names_male.txt");
        }
        return self::$namesMale;
    }

    private static function getFemaleNames() {
        if (empty(self::$namesFemale)) {
            self::$namesFemale = file(base_path() . "/resources/assets/names/names_female.txt");
        }
        return self::$namesFemale;
    }

}

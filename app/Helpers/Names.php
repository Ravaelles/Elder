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

    public static function randomMale()
    {
        if (empty(self::$namesMale)) {
            self::$namesMale = file(base_path() . "/resources/assets/names/names_male.txt");
            shuffle(self::$namesMale);
        }

        return array_shift(self::$namesMale);
    }

    public static function randomFemale()
    {
        if (empty(self::$namesFemale)) {
            self::$namesFemale = file(base_path() . "/resources/assets/names/names_female.txt");
            shuffle(self::$namesFemale);
        }

        return array_shift(self::$namesFemale);
    }

}

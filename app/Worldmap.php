<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worldmap extends Eloquent {

//    const MAP_WIDTH = 100;
//    const MAP_HEIGHT = 100;
    const MAP_WIDTH = 3500;
    const MAP_HEIGHT = 3500;

    // =========================================================================
//    private static $counter = -1;

    public static function getRandomCoordinates() {

//        $x = (int) 100 * self::$counter;
//        $y = (int) 100 * self::$counter;
//        $x = (int) 100 * self::$counter + 200;
//        $y = (int) (100 - (rand(0, 1) == 0 ? 100 : 0)) * self::$counter + 200;
//        self::$counter = self::$counter + 1;


        $x = (int) rand(0.136 * self::MAP_WIDTH, 0.9 * self::MAP_WIDTH);
        srand(self::_makeSeed());
        $y = (int) rand(0.1 * self::MAP_HEIGHT, 0.9 * self::MAP_HEIGHT);
        return ['x' => $x, 'y' => $y];
    }

    private static function _makeSeed() {
        list($usec, $sec) = explode(' ', microtime());
        return (float) $sec + ((float) $usec * 100000);
    }

}

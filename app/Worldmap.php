<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worldmap extends Eloquent {

//    const MAP_WIDTH = 100;
//    const MAP_HEIGHT = 100;
    const MAP_WIDTH = 3500;
    const MAP_HEIGHT = 3500;

    // =========================================================================

    public static function getRandomCoordinates() {
//        $x = (int) rand(0.13 * self::MAP_WIDTH, 0.9 * self::MAP_WIDTH);
        $x = (int) rand(0.1 * self::MAP_WIDTH, 0.9 * self::MAP_WIDTH);
        $y = (int) rand(0.1 * self::MAP_HEIGHT, 0.9 * self::MAP_HEIGHT);
        return ['x' => $x, 'y' => $y];
    }

}

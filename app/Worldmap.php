<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worldmap extends Eloquent {

    const WIDTH = 100;
    const HEIGHT = 100;

    // =========================================================================

    public static function getRandomCoordinates() {
        $x = (int) rand(0.1 * self::WIDTH, 0.9 * self::HEIGHT);
        $y = (int) rand(0.1 * self::HEIGHT, 0.9 * self::HEIGHT);
        return ['x' => $x, 'y' => $y];
    }

}

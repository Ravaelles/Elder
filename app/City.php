<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Location;

class City extends Location {

    function __construct() {
        parent::__construct();
    }

    public static function generate() {
        $city = new City();
        $city->set(Location::NAME, self::getRandomName());
        return $city;
    }

    // =========================================================================

    public static function getRandomName() {
        $names = [
            'Seattle',
            'Portland',
            'Redding',
            'Yakima',
            'Kennewick',
            'Bend',
            'Tacoma',
        ];
        return $names[array_rand($names)];
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Location;

class Band extends Location {

    function __construct() {
        parent::__construct();
    }

    // =========================================================================

    public static function generate() {
        $city = new Band();
        $city->set(Location::NAME, self::getRandomName());
        return $city;
    }

    public static function removeAll() {
        
    }

    // =========================================================================

    public static function getRandomName() {
        $index = array_rand(self::$names);
        $name = self::$names[$index];
        unset(self::$names[$index]);

        return $name;
    }

    // =========================================================================

    private static $names = [
        'Red Fort',
        'Menacing keep',
        'Mike\'s Ranch',
        'The Chinese',
        'The Italians',
        'The Mexicans',
        'Watohi Tribe',
        'Arakanna Tribe',
        'Wild Brood',
        'Old Creek',
        
        'Burned temple',
        'Highway outpost',
        'Empty police station',
        'Water tower',
        'Rusty factory',
//            'Seattle',
//            'Portland',
//            'Redding',
//            'Yakima',
//            'Kennewick',
//            'Bend',
//            'Tacoma',
    ];

}

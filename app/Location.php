<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Worldmap;

class Location extends Eloquent {

    const LOCATION = "location";
    const NAME = "name";

    // =========================================================================

    private static $firstFreeID = 1;

    // =========================================================================

    function __construct($location = null) {
//        $this->set(self::ID, self::$firstFreeID++);
        if ($location === null) {
            $this->assignRandomLocation();
        }
    }

    // =========================================================================

    public function assignRandomLocation() {
        $this->set(self::LOCATION, Worldmap::getRandomCoordinates());
        $this->set(self::NAME, "");

        return $this;
    }

    public function getID() {
//        var_dump($this->get(self::ID));
//        dd($this->getAttributes());
//        return $this->get(self::ID);
        return $this->get($this->primaryKey);
    }

}

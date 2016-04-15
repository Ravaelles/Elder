<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Worldmap;

class Location extends Eloquent {

    const LOCATION = "location";
    const NAME = "name";

    // =========================================================================

    function __construct($location = null) {
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

}

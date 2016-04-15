<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\City;

class Generator extends Model {

    const NUM_OF_CITIES = 10;

    public static function generateWorld() {
        $cities = [];

        // Generate cities
        for ($i = 0; $i < self::NUM_OF_CITIES; $i++) {
            $city = City::generate();
            $cities[] = $city;
            var_dump($city->getAttributes());
            $city->save();
        }

    }

}

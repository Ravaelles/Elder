<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Band;

class Generator extends Model {

    const NUM_OF_CITIES = 15;

    public static function generateWorld() {
        Band::truncate();
        $cities = [];

        // Generate cities
        for ($i = 0; $i < self::NUM_OF_CITIES; $i++) {
            $city = Band::generate();
            $cities[] = $city;
            echo "<br />City $i:<br />";
            var_dump($city->getAttributes());
            $city->save();
        }

    }

}

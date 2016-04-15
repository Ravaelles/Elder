<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Location;

class Settlement extends Location {

    public static function getRandomName() {
        return array_rand([
            'Steady Torrent',
            'Eerie',
            'Old House',
            'Tom\'s creek',
            'Weird Cave',
            'Water Tower',
        ]);
    }

}

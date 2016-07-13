<?php

namespace App\MapObjects;

use App\MapObjects\MapObject;
use App\Tiles\Tile;

class Grass extends MapObject {

    function __construct(Tile $tile) {
        parent::__construct($tile, MapObject::TYPE_GRASS);
    }

}

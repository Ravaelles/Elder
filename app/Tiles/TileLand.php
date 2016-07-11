<?php

namespace App\Tiles;

use App\Classes\Tile;
use App\Classes\MapObject;

class TileLand {

    public static function addGrass(Tile $tile) {
        $tree = new MapObject($tile, MapObject::TYPE_GRASS);
        $tile->addMapObject($tree);
    }

}

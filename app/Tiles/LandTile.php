<?php

namespace App\Tiles;

use App\Classes\Tile;
use App\Classes\MapObject;

class LandTile {

    public static function generateGrassInTile(Tile $tile) {
        for ($i = 0; $i < 5; $i++) {
            self::generateGrass($tile);
        }
    }

    // =========================================================================

    private static function generateGrass($tile) {
        $grass = new MapObject($tile, MapObject::TYPE_GRASS);
        $grass->spreadImageInTile();
        $tile->addMapObject($grass);
    }

}

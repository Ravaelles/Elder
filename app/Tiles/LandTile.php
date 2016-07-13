<?php

namespace App\Tiles;

use App\Tiles\Tile;
use App\MapObjects\MapObject;
use App\MapObjects\Grass;

class LandTile {

    public static function generateGrassInTile(Tile $tile) {
        for ($i = 0; $i < 10; $i++) {
            self::generateGrass($tile);
        }
    }

    // =========================================================================

    private static function generateGrass($tile) {
        $grass = new Grass($tile);
        $grass->spreadImageInTile();
        $tile->addMapObject($grass);
    }

}

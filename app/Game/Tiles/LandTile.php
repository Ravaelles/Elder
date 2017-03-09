<?php

namespace App\Game\Tiles;

use App\Game\Tiles\Tile;
use App\Game\MapObjects\MapObject;
use App\Game\MapObjects\Grass;

class LandTile {

    public static function generateGrassInTile(Tile $tile) {
        for ($i = 0; $i < 1; $i++) {
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

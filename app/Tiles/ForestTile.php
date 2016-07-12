<?php

namespace App\Tiles;

use App\Classes\Tile;
use App\Classes\MapObject;

class ForestTile {

    public static function generateTreesInTile(Tile $tile) {
        for ($i = 0; $i < 2; $i++) {
            self::generateTree($tile);
        }
    }

    // =========================================================================

    private static function generateTree($tile) {
        $tree = new MapObject($tile, MapObject::TYPE_TREE);
        $tree->spreadImageInTile();
        $tile->addMapObject($tree);
    }

}

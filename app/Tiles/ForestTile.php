<?php

namespace App\Tiles;

use App\Tiles\Tile;
use App\MapObjects\Tree;

class ForestTile {

    public static function generateTreesInTile(Tile $tile) {
        for ($i = 0; $i < 7; $i++) {
            self::generateTree($tile);
        }
    }

    // =========================================================================

    private static function generateTree($tile) {
        $tree = new Tree($tile);
        $tree->spreadImageInTile();
        $tile->addMapObject($tree);
    }

}

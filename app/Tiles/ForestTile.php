<?php

namespace App\Tiles;

use App\Classes\Tile;
use App\Classes\MapObject;

class ForestTile {

    public static function addTrees(Tile $tile) {
        $tree = new MapObject($tile, MapObject::TYPE_TREE);
        $tile->addMapObject($tree);
    }

}

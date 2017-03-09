<?php

namespace App\Game\Tiles;

use App\World;
use App\Game\MapObjects\MapObject;
use App\Helpers\Images;
use App\Game\Tiles\ForestTile;
use App\Game\Tiles\LandTile;

class Location {

    public static function getRandomTile() {
        $width = self::getWorld()->getTilesWidth();
        $height = self::getWorld()->getTilesHeight();
        $y = rand(0, $width - 1);
        $x = rand(0, $height - 1);
        $tile = self::getWorld()->getTile($x, $y);
        return $tile;
    }

    // =========================================================================

    private static function getWorld() {
        return World::getInstance();
    }

}

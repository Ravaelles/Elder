<?php

namespace App;

use App\Classes\Tile;
use App\Tiles\ForestTile;

class WorldGenerator {

    const WORLD_TILES_WIDTH = 4;
    const WORLD_TILES_HEIGHT = 3;

    public static function generateWorld() {
        $world = new World(self::WORLD_TILES_WIDTH, self::WORLD_TILES_HEIGHT);
        self::generateTiles($world);
        return $world;
    }

// =========================================================================

    public static function generateTiles($world) {
        for ($row = 0; $row < $world->getTilesHeight(); $row++) {
            for ($column = 0; $column < $world->getTilesWidth(); $column++) {
                $tile = $world->getTile($row, $column);

                if (rand(1, 10) <= 2) {
                    $tile->setType(Tile::TYPE_MOUNTAIN);
                }

                if (rand(1, 10) <= 2) {
                    $tile->setType(Tile::TYPE_FOREST);
                }

//                echo
//                <img class="map-object" style="top: {{ $y * 80 }}px; left: {{ $x * 80 }}px"
//                     src="/img/world/land/grass_{{ rand(1, 3) }}.png">
                $tile->generateTileAccordingToType();
//                dd($world->getTile($row, $column));
            }
        }
    }

}

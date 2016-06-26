<?php

namespace App;

use App\Classes\Tile;

class WorldGenerator {

    const WORLD_TILES_WIDTH = 20;
    const WORLD_TILES_HEIGHT = 8;

    public static function generateWorld() {
        $world = new World(self::WORLD_TILES_WIDTH, self::WORLD_TILES_HEIGHT);
        self::handleTiles($world);
        return $world;
    }

// =========================================================================

    public static function handleTiles($world) {
        for ($row = 0; $row < $world->tilesHeight; $row++) {
            for ($column = 0; $column < $world->tilesWidth; $column++) {
                $tile = $world->getTile($row, $column);

                if (rand(1, 10) <= 2) {
                    $tile->setType(Tile::TYPE_MOUNTAIN);
                }

//                echo
//                <img class="map-object" style="top: {{ $y * 80 }}px; left: {{ $x * 80 }}px"
//                     src="/img/world/land/grass_{{ rand(1, 3) }}.png">
                $tile->assignTextureAccordingToType();
//                dd($world->getTile($row, $column));
            }
        }
    }

}

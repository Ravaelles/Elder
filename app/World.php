<?php

namespace App;

use App\Classes\Tile;

class World extends Eloquent {

    public $tilesWidth = -1;
    public $tilesHeight = -1;
    public $tiles = [];
    public $mapObjects = [];

    // =========================================================================

    function __construct($tilesWidth, $tilesHeight) {
        $this->tilesWidth = $tilesWidth;
        $this->tilesHeight = $tilesHeight;

        $this->_initializeTilesArray();
    }

    public function getTile($row, $column) {
        return $this->tiles[$row][$column];
    }

    // =========================================================================

    public function createJson() {
        return json_encode([
            'map-width' => $this->tilesWidth,
            'map-height' => $this->tilesHeight,
            'tiles' => $this->tiles,
            'map-objects' => $this->mapObjects,
        ]);
//        return $this->getJson();
//        json_encode($world->getAttributes())
    }

    // =========================================================================

    private function _initializeTilesArray() {
        $this->tiles = [];
        for ($i = 0; $i < $this->tilesHeight; $i++) {
//            $row = array_fill(0, $this->tilesWidth, []);
            $row = [];
            for ($j = 0; $j < $this->tilesWidth; $j++) {
                $row[$j] = new Tile(Tile::TYPE_LAND);
            }

            $this->tiles[$i] = $row;
        }

//        dd($this->tiles);
    }

}

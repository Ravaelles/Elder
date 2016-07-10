<?php

namespace App;

use App\Classes\Tile;
use App\Classes\MapObject;

class World extends Eloquent {

    private $tilesWidth = -1;
    private $tilesHeight = -1;
    private $tiles = [];
    private $mapObjects = [];

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
//        dd($this->createTilesArray());
//        return str_replace(['\"', "\""], ["'", "'"], json_encode([
        return json_encode([
            'map-width' => $this->tilesWidth,
            'map-height' => $this->tilesHeight,
//            'tiles' => $this->createTilesArray(),
            'tiles' => $this->tiles,
            'map-objects' => $this->mapObjects,
        ]);
//        ]));
//        return $this->getJson();
//        json_encode($world->getAttributes())
    }

//    private function createTilesArray() {
////        return json_encode($this->tiles);
//
//        $array = [];
//        for ($i = 0; $i < count($this->tiles); $i++) {
//            for ($j = 0; $j < count($this->tiles[$i]); $j++) {
//                $tileString = $this->tiles[$i][$j]->__toString();
//                $tileString = str_replace("\"", "'", $tileString);
//                $array[$i][$j] = $tileString;
//            }
//        }
//        return $array;
//    }
    // =========================================================================

    private function _initializeTilesArray() {
        $this->tiles = [];
        for ($y = 0; $y < $this->tilesHeight; $y++) {
//            $row = array_fill(0, $this->tilesWidth, []);
            $row = [];
            for ($x = 0; $x < $this->tilesWidth; $x++) {
                $row[$x] = new Tile($this, Tile::TYPE_LAND, $x, $y);
            }

            $this->tiles[$y] = $row;
        }

//        dd($this->tiles);
    }

    public function addMapObject(MapObject $mapObject) {
        $this->mapObjects[] = $mapObject;
    }

    // =========================================================================

    function getTilesWidth() {
        return $this->tilesWidth;
    }

    function getTilesHeight() {
        return $this->tilesHeight;
    }

    function getTiles() {
        return $this->tiles;
    }

    function getMapObjects() {
        return $this->mapObjects;
    }

}

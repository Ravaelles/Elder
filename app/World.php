<?php

namespace App;

use App\Game\MapObjects\MapObject;
use App\Game\Tiles\Tile;

class World extends Eloquent
{

    private static $world = null;

    private $tilesWidth = -1;
    private $tilesHeight = -1;
    private $tiles = [];
    private $mapObjects = [];
    private $settlements = [];

    // =========================================================================

    public function createJson()
    {
//        dd($this->createTilesArray());
//        return str_replace(['\"', "\""], ["'", "'"], json_encode([
        //ddd($this->tiles);
        return json_encode([
            'map-width' => $this->tilesWidth,
            'map-height' => $this->tilesHeight,
//            'tiles' => $this->createTilesArray(),
            'tiles' => $this->tiles,
            'map-objects' => $this->mapObjects,
            'settlements' => $this->settlements,
        ]);
//        ]));
//        return $this->getJson();
//        json_encode($world->getAttributes())
    }

    // =========================================================================

    function __construct($tilesWidth, $tilesHeight)
    {
        $this->tilesWidth = $tilesWidth;
        $this->tilesHeight = $tilesHeight;

        $this->tiles = [];
        for ($y = 0; $y < $this->tilesHeight; $y++) {
            $row = [];
            for ($x = 0; $x < $this->tilesWidth; $x++) {
                $row[$x] = new Tile($this, Tile::TYPE_LAND, $x, $y);
            }
            $this->tiles[$y] = $row;
        }

//        dd($this->tiles);
        self::$world = $this;
    }

    public static function getInstance() {
        return self::$world;
    }

    // =========================================================================

//    private function _initializeTilesArray() {
//
//    }

    public function addMapObject(MapObject $mapObject)
    {
        $this->mapObjects[] = $mapObject;
    }

    public function addSettlement(Settlement $settlement)
    {
        $this->settlements[] = $settlement;
    }

    // =========================================================================

    public function getTile($row, $column)
    {
        return $this->tiles[$row][$column];
    }

    function getTilesWidth()
    {
        return $this->tilesWidth;
    }

    function getTilesHeight()
    {
        return $this->tilesHeight;
    }

    function getTiles()
    {
        return $this->tiles;
    }

    function getMapObjects()
    {
        return $this->mapObjects;
    }

    /**
     * @return array
     */
    public function getSettlements()
    {
        return $this->settlements;
    }


}

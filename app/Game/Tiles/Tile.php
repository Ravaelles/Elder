<?php

namespace App\Game\Tiles;

use App\World;
use App\Game\MapObjects\MapObject;
use App\Helpers\Images;
use App\Game\Tiles\ForestTile;
use App\Game\Tiles\LandTile;

class Tile implements \JsonSerializable {

    const TILE_SIZE = 200;
    const TYPE_LAND = 'land';
    const TYPE_MOUNTAIN = 'mountain';
    const TYPE_FOREST = 'forest';

    // =========================================================================

    private $world = null;
    private $type = null;
    private $x = null;
    private $y = null;
    private $image = null;
    private $mapObjects = [];

    // =========================================================================

    function __construct(World $world, $type, $x, $y) {
        $this->world = $world;
        $this->type = $type;
        $this->x = $x;
        $this->y = $y;
    }

    // =========================================================================

    public function generateTileAccordingToType() {

        // Assign surface texture
        $this->image = Images::getTextureLand();

        // Mountain
        if ($this->type === self::TYPE_LAND) {
            LandTile::generateGrassInTile($this);
        }

        // Mountain
        else if ($this->type === self::TYPE_MOUNTAIN) {
            
        }

        // Forest
        else if ($this->type === self::TYPE_FOREST) {
            ForestTile::generateTreesInTile($this);
        }

        // Unknown type
        else {
            die("Unknown tile type: " . $this->type);
        }
    }

    public function addMapObject(MapObject $mapObject) {
        array_push($this->mapObjects, $mapObject);
        $this->world->addMapObject($mapObject);
    }

    // =========================================================================

    public function jsonSerialize() {
        return [
            'type' => $this->type,
            'image' => $this->image,
        ];
    }

    // =========================================================================

    function getType() {
        return $this->type;
    }

    function setType($type) {
        $this->type = $type;
    }

    function getMapObjects() {
        return $this->mapObjects;
    }

    function getWorld() {
        return $this->world;
    }

    function getX() {
        return $this->x;
    }

    function getY() {
        return $this->y;
    }

    function setX($x) {
        $this->x = $x;
    }

    function setY($y) {
        $this->y = $y;
    }

}

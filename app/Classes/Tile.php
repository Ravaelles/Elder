<?php

namespace App\Classes;

use App\Helpers\Images;

class Tile {

    const TYPE_LAND = 'land';
    const TYPE_MOUNTAIN = 'mountain';

    // =========================================================================

    private $type = null;
    private $image = null;
    private $mapObjects = [];

    // =========================================================================

    function __construct($type) {
        $this->type = $type;
    }

    // =========================================================================

    public function assignTextureAccordingToType() {
        $this->image = Images::getRandomFile($this->type);
//        if ($this->type === self::TYPE_LAND) {
//            $this->image = Images::getTextureLand();
//        } else if ($this->type === self::TYPE_MOUNTAIN) {
//            $this->image = Images::getTextureMountain();
//        } else {
//            dd("WTF?!?");
//        }
    }

    public function addMapObject(MapObject $mapObject) {
        array_push($this->mapObjects, $mapObject);
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

}

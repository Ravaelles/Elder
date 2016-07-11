<?php

namespace App\Classes;

use App\Helpers\Images;
use App\Classes\Tile;

class MapObject implements \JsonSerializable {

    const TYPE_GRASS = 'grass';
    const TYPE_MOUNTAIN = 'mountain';
    const TYPE_TREE = 'tree';

    // =========================================================================

    private $tile = null;
    private $type = null;
    private $image = null;
    private $dx = 0;
    private $dy = 0;

    // =========================================================================

    function __construct(Tile $tile, $type) {
        $this->tile = $tile;
        $this->type = $type;
        $this->assignImageAccordingToType();
        $this->spreadImageInTile();
    }

    // =========================================================================

    private function assignImageAccordingToType() {
        $this->image = Images::getRandomFile($this->type);
//        if ($this->type === self::TYPE_LAND) {
//            $this->image = Images::getTextureLand();
//        } else if ($this->type === self::TYPE_MOUNTAIN) {
//            $this->image = Images::getTextureMountain();
//        } else {
//            dd("WTF?!?");
//        }
    }

    private function spreadImageInTile() {
        $spreadFactor = 0.4;
        $this->dx = $spreadFactor - rand(0, 20 * $spreadFactor) / 10;
        $this->dy = $spreadFactor - rand(0, 20 * $spreadFactor) / 10;
    }

    // =========================================================================

    public function jsonSerialize() {
        return [
            'type' => $this->type,
            'image' => $this->image,
            'x' => $this->tile->getX(),
            'y' => $this->tile->getY(),
            'dx' => $this->dx,
            'dy' => $this->dy,
        ];
    }

    // =========================================================================

    function getType() {
        return $this->type;
    }

    function setType($type) {
        $this->type = $type;
    }

    function getTile() {
        return $this->tile;
    }

    function getImage() {
        return $this->image;
    }

    function setTile($tile) {
        $this->tile = $tile;
    }

    function setImage($image) {
        $this->image = $image;
    }

}

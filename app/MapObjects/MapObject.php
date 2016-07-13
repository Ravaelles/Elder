<?php

namespace App\MapObjects;

use App\Helpers\Images;
use App\Tiles\Tile;

class MapObject implements \JsonSerializable {

    const TYPE_GRASS = 'grass';
    const TYPE_MOUNTAIN = 'mountain';
    const TYPE_TREE = 'tree';
    const VERTICAL_ALIGN_CENTER = 'center';
    const VERTICAL_ALIGN_BOTTOM = 'bottom';

    // =========================================================================

    private $tile = null;
    private $verticalAlign = self::VERTICAL_ALIGN_CENTER;
    private $type = null;
    private $image = null;
    private $dTX = 0;
    private $dTY = 0;

    // =========================================================================

    function __construct(Tile $tile, $type) {
        $this->tile = $tile;
        $this->type = $type;
        $this->assignImageAccordingToType();
    }

    // =========================================================================

    public function spreadImageInTile() {
        $spreadFactor = 0.4;
        $this->dTX = $spreadFactor - mt_rand(0, 20 * $spreadFactor) / 10;
        $this->dTY = $spreadFactor - mt_rand(0, 20 * $spreadFactor) / 10;
    }

    // =========================================================================

    public function jsonSerialize() {
        $imageSize = Images::getImageSize($this->image);
        return [

            // Type of this map object e.g. grass, tree
            'type' => $this->type,
            // Url of the file image
            'image' => $this->image,
            // If "center" image will be aligned to the center of the image in tile,
            // if "bottom" image will be aligned to the bottom of the image in tile
            'vertical-align' => $this->verticalAlign,
            // Image width in pixels
            'width' => $imageSize['width'],
            // Image height in pixels
            'height' => $imageSize['height'],
            // Tile X
            'TX' => $this->tile->getX(),
            // Tile Y
            'TY' => $this->tile->getY(),
            // Spread modifier for X (causes objects to be elsewhere than in exact center of tile)
            'dTX' => $this->dTX,
            // Spread modifier for Y (causes objects to be elsewhere than in exact center of tile)
            'dTY' => $this->dTY,
        ];
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

    protected function setVerticalAlignOfImageToBottom() {
        $this->verticalAlign = self::VERTICAL_ALIGN_BOTTOM;
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

    function getVerticalAlign() {
        return $this->verticalAlign;
    }

}

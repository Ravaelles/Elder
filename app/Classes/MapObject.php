<?php

namespace App\Classes;

use App\Helpers\Images;

class MapObject {

    const TYPE_MOUNTAIN = 'mountain';

    // =========================================================================

    public $type = null;
    public $image = null;

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

    // =========================================================================

    function getType() {
        return $this->type;
    }

    function setType($type) {
        $this->type = $type;
    }

}

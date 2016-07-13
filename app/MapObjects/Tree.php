<?php

namespace App\MapObjects;

use App\MapObjects\MapObject;
use App\Tiles\Tile;

class Tree extends MapObject {

    function __construct(Tile $tile) {
        parent::__construct($tile, MapObject::TYPE_TREE);
        $this->setVerticalAlignOfImageToBottom();
    }

}

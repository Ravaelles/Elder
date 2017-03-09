<?php

namespace App\Game\MapObjects;

use App\Game\MapObjects\MapObject;
use App\Game\Tiles\Tile;

class Tree extends MapObject {

    function __construct(Tile $tile) {
        parent::__construct($tile, MapObject::TYPE_TREE);
        $this->setVerticalAlignOfImageToBottom();
    }

}

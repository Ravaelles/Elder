<?php

namespace App;

use App\Game\Tiles\Location;
use App\Game\Tiles\Tile;
use App\Game\Tiles\ForestTile;

class Settlement implements \JsonSerializable {

    private $tribe;
    private $tile;
    private $population;

    // =========================================================================

    public static function generateSettlement() {
        $settlement = new Settlement();

        $settlement->assignLocation();
        $settlement->assignPopulation();
        $settlement->assignTribe();

        return $settlement;
    }

    // =========================================================================

    public function jsonSerialize()
    {
        return json_encode([
            'x' => $this->tile->getX(),
            'y' => $this->tile->getY(),
        ]);
    }

    // =========================================================================

    private function assignLocation() {
        $this->tile = Location::getRandomTile();
    }

    private function assignPopulation() {
        $this->population = rand(41, 45);
    }

    private function assignTribe() {
        $this->tribe = Tribe::introduceNewTribe();
    }

}

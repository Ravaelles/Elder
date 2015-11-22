<?php

namespace App\Helpers;

use App\Critter as Critter;
use App\Helpers\CritterImage as CritterImage;

class Image {

    const CRITTERS_DIR = "/img/critter/all/";

    // =========================================================================
    // Auxiliary factory

//    public static function create($id) {
//        $critterImage = new CritterImage;
//        $critterImage->id = $id;
//        return $critterImage;
//    }
    // =========================================================================
    // Main functionality

    public static function gifFor($id, $critter, $action = null, $direction = null, $sex = null) {

        // ACTION
        if ($action == null) {
            $action = Critter::ACTION_IDLE;
        }

        // DIRECTION
        if ($direction == null) {
            $direction = Critter::DIR_SE;
        }

        // SEX
        if ($sex == null) {
            $sex = Critter::MALE;
        }

        // =========================================================================

        $idString = !empty($id) ? "id='unit-id-$id'" : "";
        $imgName = self::CRITTERS_DIR . $sex . $critter . $action . "_" . $direction;

        return "<img $idString src='$imgName.gif' />";
    }

}
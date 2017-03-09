<?php

namespace App\Helpers;

use App\Unit as Unit;
use App\Helpers\UnitImage as UnitImage;

class Image {

    const CRITTERS_DIR = "/img/critter/all/";

    // =========================================================================
    // Auxiliary factory

//    public static function create($id) {
//        $unitImage = new UnitImage;
//        $unitImage->id = $id;
//        return $unitImage;
//    }
    // =========================================================================
    // Main functionality

    public static function gifFor($id, $type, $action = null, $direction = null, $sex = null) {

        // ACTION
        if ($action == null) {
            $action = Unit::ACTION_IDLE;
        }

        // DIRECTION
        if ($direction == null) {
            $direction = Unit::DIR_SE;
        }

        // SEX
        if ($sex == null) {
            $sex = Unit::MALE;
        }

        // =========================================================================

        $idString = !empty($id) ? "id='unit-img-$id'" : "";
        $imgName = self::CRITTERS_DIR . $sex . $type . $action . "_" . $direction;

        return "<img $idString src='$imgName.gif' />";
    }

}
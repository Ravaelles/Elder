<?php

namespace App\Helpers;

use App\Critter as Critter;
use App\Helpers\CritterImage as CritterImage;

class Image {

    const CRITTERS_DIR = "/img/critter/all/";

    // =========================================================================
    // Auxiliary factory

    public static function create() {
        return new CritterImage;
    }

    // =========================================================================
    // Main functionality

    public static function gifFor($critter, $action = null, $direction = null, $sex = null) {

        // ACTION
        if ($action == null) {
            $action = Critter::ACTION_IDLE;
        } else if ($action === Critter::ACTION_RANDOM_STATIC) {
            $randomStaticActions = [
                Critter::ACTION_DODGE,
                Critter::ACTION_HAND_COMBAT,
                Critter::ACTION_IDLE,
                Critter::ACTION_PICK_UP,
                Critter::ACTION_USE,
            ];
            $action = $randomStaticActions[mt_rand(0, count($randomStaticActions) - 1)];
        }

        // DIRECTION
        if ($direction == null) {
            $direction = Critter::DIR_SE;
        }

        // SEX
        if ($sex == null) {
            $sex = Critter::MALE;
        }

        $imgName = self::CRITTERS_DIR . $sex . $critter . $action . $direction;
        return "<img src='$imgName.gif' class='' />";
    }

}
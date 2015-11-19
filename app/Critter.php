<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Critter extends Eloquent {

    // Actions
    const ACTION_IDLE = "aa";
    const ACTION_WALK = "ab";
    const ACTION_CLIMB_UP = "ae";
    const ACTION_PICK_UP = "ak";
    const ACTION_USE = "al";
    const ACTION_DODGE = "an";
    const ACTION_HIT = "ao";
    const ACTION_HIT2 = "ap";
    const ACTION_HAND_COMBAT = "aq";
    const ACTION_KICK = "ar";
    const ACTION_THROW = "as";
    const ACTION_RUN = "at";
    const ACTION_RANDOM_STATIC = "RANDOM_STATIC";
    // =========================================================================
    // Spear
    const SPEAR_IDLE = "ga";
    const SPEAR_WALK = "gb";
    const SPEAR_EQUIP = "gc";
    const SPEAR_UNEQUIP = "gd";
    const SPEAR_DODGE = "ge";
    const SPEAR_THRUST = "gf";
    const SPEAR_THROW = "gm";
    const SPEAR_RANDOM = "RANDOM_SPEAR";
    // =========================================================================
    // Direction
    const DIR_W = "w";
    const DIR_E = "e";
    const DIR_NW = "nw";
    const DIR_NE = "ne";
    const DIR_SW = "sw";
    const DIR_SE = "se";
    const DIR_ALL = [self::DIR_W, self::DIR_E, self::DIR_NW, self::DIR_NE, self::DIR_SW, self::DIR_SE];
    // =========================================================================
    // People
    const WARRIOR_MALE = "warr";
    const WARRIOR_FEMALE = "prim";
    // =========================================================================
    // Sex
    const MALE = "nm";
    const FEMALE = "nf";

}

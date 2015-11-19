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
    const DIR_W = "_w";
    const DIR_E = "_e";
    const DIR_NW = "_nw";
    const DIR_NE = "_ne";
    const DIR_SW = "_sw";
    const DIR_SE = "_se";
    // =========================================================================
    // People
    const WARRIOR_MALE = "warr";
    const WARRIOR_FEMALE = "prim";
    // =========================================================================
    // Sex
    const MALE = "nm";
    const FEMALE = "nf";

}

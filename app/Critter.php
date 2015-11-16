<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Critter extends Eloquent {

    // Actions
    const ACTION_BASE = "a";
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
    const WARRIOR_M = "nmwarr";
    const WARRIOR_F = "nfwarr";

}

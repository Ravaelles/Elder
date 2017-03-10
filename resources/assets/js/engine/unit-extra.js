function buildStyleStringForImg(image, unit, staticImageMode, imageWrapperSelector, width, height) {
    var styleString = "position: relative; ";

    // =========================================================================
    // Handle static mode (just ui animation) or regular, engine mode
    if (staticImageMode) {
        image.marginLeft = imageWrapperSelector.width() / 2 - width / 2;
        image.marginTop = imageWrapperSelector.height() / 2 - height / 2;

        if (unit._action === SPEAR_EQUIP || unit._action === SPEAR_UNEQUIP) {
            image.marginTop -= 18;
            image.marginLeft -= 17;
        }
    }
    else {
        image.marginLeft = -width / 2;
        image.marginTop = -height;

        // =========================================================================
        // Alter WALK animations
        if (unit.isActionWalk()) {

            // Define horizontal movement factor
            if (unit.isActionWithWeapon(WEAPON_SPEAR)) {
                var walkFactor = 0.25; // Spear
                var diagonalWalkFactor = 0.3;
            }
            else {
                var walkFactor = 0.38; // Walk
                var diagonalWalkFactor = 0.32;
            }

            // Define diagonal movement favtor
            var walkToNorthMarginTopBonus = height / 5;

            if (unit._dir === DIR_E) {
                image.marginLeft += width * walkFactor;
            }
            else if (unit._dir === DIR_W) {
                image.marginLeft += (-width * walkFactor);
            }
            else if (unit._dir === DIR_SE) {
                image.marginLeft += width * diagonalWalkFactor;
                image.marginTop += height * diagonalWalkFactor;
            }
            else if (unit._dir === DIR_SW) {
                image.marginLeft -= width * diagonalWalkFactor;
                image.marginTop += height * diagonalWalkFactor;
            }
            else if (unit._dir === DIR_NW) {
                image.marginLeft += (-width * diagonalWalkFactor);
                image.marginTop += (-height * diagonalWalkFactor + walkToNorthMarginTopBonus);
            }
            else if (unit._dir === DIR_NE) {
                image.marginLeft += width * diagonalWalkFactor;
                image.marginTop += (-height * diagonalWalkFactor + walkToNorthMarginTopBonus);
            }
        }

        // =========================================================================
        // Alter SPEAR
        if (unit._action === SPEAR_EQUIP || unit._action === SPEAR_UNEQUIP) {
            if (unit._dir === DIR_SE) {
                image.marginLeft -= 14;
                image.marginTop += 8;
            }
            else if (unit._dir === DIR_SW) {
                image.marginLeft -= 18.5;
            }
            else if (unit._dir === DIR_NE) {
                image.marginLeft += 18;
                image.marginTop += 3.5;
            }
            else if (unit._dir === DIR_NW) {
                image.marginLeft += 15;
            }
            else if (unit._dir === DIR_E) {
                image.marginLeft -= 5;
                image.marginTop += 12;
            }
            else if (unit._dir === DIR_W) {
                image.marginLeft += 4;
            }
        }
    }

    // =========================================================================
    // Include position factor
    image.marginLeft += unit.positionPX;
    image.marginTop += unit.positionPY;

    // =========================================================================
    // Handle margin
    if (image.marginLeft) {
        styleString += "left:" + image.marginLeft + "px; "
    }
    if (image.marginTop) {
        styleString += "top:" + image.marginTop + "px; "
        styleString += "z-index: " + (image.marginTop + height) + "; "
    }
    //                styleString += "border: 1px solid red !important; ";

    return styleString;
}

// =========================================================================

// Actions
ACTION_IDLE = "aa";
ACTION_WALK = "ab";
ACTION_CLIMB_UP = "ae";
ACTION_PICK_UP = "ak";
ACTION_USE = "al";
ACTION_DODGE = "an";
ACTION_HIT = "ao";
ACTION_HIT2 = "ap";
ACTION_HAND_COMBAT = "aq";
ACTION_KICK = "ar";
ACTION_THROW = "as";
ACTION_RUN = "at";
ACTION_RANDOM_STATIC = "RANDOM_STATIC";
// =========================================================================
// Spear actions
SPEAR_IDLE = "ga";
SPEAR_WALK = "gb";
SPEAR_EQUIP = "gc";
SPEAR_UNEQUIP = "gd";
SPEAR_DODGE = "ge";
SPEAR_THRUST = "gf";
SPEAR_THROW = "gm";
SPEAR_RANDOM = "RANDOM_SPEAR";

// =========================================================================
// Weapons
WEAPON_SPEAR = "SPEAR";
WEAPON_10MM_PISTOL = "10MM";

// =========================================================================
// Direction
DIR_W = "w";
DIR_E = "e";
DIR_NW = "nw";
DIR_NE = "ne";
DIR_SW = "sw";
DIR_SE = "se";
DIR_ALL = [DIR_W, DIR_E, DIR_NW, DIR_NE, DIR_SW, DIR_SE];
function DIR_RANDOM() {
    return randElem(DIR_ALL);
}
function DIR_RANDOM_SOUTH() {
    return randElem([DIR_SW, DIR_SE]);
}
function DIR_RANDOM_NORTH() {
    return randElem([DIR_NW, DIR_NE]);
}

// =========================================================================
// People
WARRIOR_MALE = "warr";
WARRIOR_FEMALE = "prim";
SEX_GIRL = "/img/special/sex-girl.png";
// =========================================================================
// Nature
NATURE_TREE = "nature_tree";
NATURE_GRASS = "nature_grass";
// =========================================================================
// Sex
MALE = "nm";
FEMALE = "nf";

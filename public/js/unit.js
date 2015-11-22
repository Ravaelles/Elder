/**
 * This class represents animated unit/sprite/critter to be displayed in the browser.
 * It's possible to change unit and animate it using animate() function. Commands can be chained like:
 * <p>var unit = new Unit(json).create()</p>
 *
 * Unit is identified by:
 * - sex - MALE/FEMALE
 * - dir - direction unit is facing - DIR_E, DIR_W, DIR_SE, DIR_SW, DIR_NE, DIR_NW 0
 * - action - currently executed action - choose one of many constans prefixed ACTION_, SPEAR_ etc
 * - critter - Fallout identifier of the critter in the gif, use constants lik WARRIOR_MALE, WARRIOR_FEMALE etc
 *
 * @param string json json string that will be used to create object
 * @returns Unit
 */
function Unit(json) {

    this.id = null; // Unique identifier for the unit
    this.sex = null; // Sex of this unit, use MALE or FEMALE
    this._action = null; // Curenntly executed action, use ACTION_* and others
    this._dir = null; // Direction unit is facing, use DIR_*
    this.critter = null; // Type of this unit e.g. WARRIOR_MALE, WARRIOR_FEMALE

    this.marginLeft = 0;
    this.marginTop = 0;

    this._lastAnimationStarted = 0;

    // =========================================================================
    // Constructor

    this.constructor = function (json) {
        var parameters = JSON.parse(json);
        this.id = parameters['id'];
        this.sex = parameters['sex'];
        this._action = parameters['action'];
        this._dir = parameters['dir'] ? parameters['dir'] : "se";
        this.critter = parameters['critter'];
    };
    this.constructor(json);

    // =========================================================================
    // Methods

    this.display = function () {
        var img = this.createImageElement();
        $("#unit-id-" + this.id).html(img);
    };

    this.animate = function (options, afterTime) {
        if (!afterTime) {
            afterTime = 0;
        }

        var unit = this;
        setTimeout(function () {
            if (options && typeof options.action != 'undefined') {
                unit._action = options.action;
            }
            if (options && typeof options.sex != 'undefined') {
                unit.sex = options.sex;
            }
            if (options && typeof options.dir != 'undefined') {
                unit._dir = options.dir;
            }
            if (options && typeof options.critter != 'undefined') {
                unit.critter = options.critter;
            }
            unit.display();
        }, afterTime);

        this._lastAnimationStarted += afterTime;

        return this;
    };

    this.nextAnimate = function (options, afterTime) {
        return this.animate(options, this._lastAnimationStarted + afterTime);
    };

    // =========================================================================
    // Low-level methods

    this.createImageElement = function () {
        var idString = this.id ? "id='unit-id-" + this.id + "'" : "";
        var imgName = "/img/critter/all/" + this.sex + this.critter + this._action + "_" + this._dir;
        var randomString = "?" + rand(100000, 999999);

        // =========================================================================
        // Direction issues
//        if (!this.isActionStatic()) {
//            if (this.dirTowardEast()) {
//                this.marginLeft = 0;
//            }
//            else if (this.dirTowardWest()) {
//                this.marginLeft = 0;
//            }
//        }

        // =========================================================================
        // Style
        var style = "";
        if (this.marginLeft) {
            style += "margin-left:" + this.marginLeft + "px; "
        }
        if (this.marginTop) {
            style += "margin-top:" + this.marginTop + "px; "
        }

        return "<img " + idString + " src='" + imgName + ".gif" + randomString + "' style='" + style + "' />";
    };

    this.dirTowardEast = function () {
        return [DIR_E, DIR_SE, DIR_NE].indexOf(this._dir) != -1;
    };

    this.dirTowardWest = function () {
        return [DIR_W, DIR_NW, DIR_SW].indexOf(this._dir) != -1;
    };

//    this.isActionStatic = function () {
//        return [ACTION_IDLE, SPEAR_IDLE].indexOf(this._dir) != -1;
//        return false;
//    };

    // =========================================================================
    // Getters and Setters

    /**
     * Getter or Setter for <b>dir</b> field.
     */
    this.dir = function (newDir) {
        if (newDir !== undefined) {
            this._dir = newDir;
        }
        else {
            return this._dir;
        }
    };

    /**
     * Getter or Setter for <b>action</b> field.
     */
    this.action = function (newAction) {
        if (newAction !== undefined) {
            this._action = newAction;
        }
        else {
            return this._action;
        }
    };

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
// Spear
SPEAR_IDLE = "ga";
SPEAR_WALK = "gb";
SPEAR_EQUIP = "gc";
SPEAR_UNEQUIP = "gd";
SPEAR_DODGE = "ge";
SPEAR_THRUST = "gf";
SPEAR_THROW = "gm";
SPEAR_RANDOM = "RANDOM_SPEAR";
// =========================================================================
// Direction
DIR_W = "w";
DIR_E = "e";
DIR_NW = "nw";
DIR_NE = "ne";
DIR_SW = "sw";
DIR_SE = "se";
DIR_ALL = [DIR_W, DIR_E, DIR_NW, DIR_NE, DIR_SW, DIR_SE];
function DIR_RANDOM_SOUTH() {
    return randElem([DIR_SW, DIR_SE]);
}

// =========================================================================
// People
WARRIOR_MALE = "warr";
WARRIOR_FEMALE = "prim";
SEX_GIRL = "/img/special/sex-girl.png";
// =========================================================================
// Nature
TREE = "";
// =========================================================================
// Sex
MALE = "nm";
FEMALE = "nf";

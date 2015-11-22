var allUnits = [];

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

    this.disallowNegativeMargin = false;
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
        allUnits[this.id] = this;
    };
    this.constructor(json);

    // =========================================================================
    // Methods

    this.display = function (disallowNegativeMargin) {
//        var img = this.createImageElement(function () {
//            $("#unit-id-" + this.id).html(img);
//        });
        this.disallowNegativeMargin = disallowNegativeMargin;

        var imgObject = this.createImageElement();
        var imageElement = imgObject['imageElement'];
        var imagePath = imgObject['imagePath'];

        // =========================================================================

        var myImage = new Image();
        myImage.unitId = this.id;
        myImage.unit = this;
//        myImage.styleForWrapper = imgObject['style'];
        myImage.imageIsLoaded = false;
        myImage.onload = function (event) {
            if (this.imageIsLoaded) {
                return;
            }
            else {
                var unit = this.unit;
                this.imageIsLoaded = true;
                this.src = imagePath;
//                allUnits[this.unitId]['imgWidth'] = this.width;
//                allUnits[this.unitId]['imgHeight'] = this.height;
                var width = this.width;
                var height = this.height;

                var imageWrapperSelector = $("#unit-wrapper-" + this.unitId);

                // Add ready <img src=> element to the div wrapper, thus displaying the animation
                imageWrapperSelector.html(imageElement);

                // Assign current image dimensions to the image element
                var imageSelector = $("#unit-img-" + this.unitId);
                imageSelector.attr({"imgwidth": width, "imgheight": height});
                imageSelector.click(function () {
                    console.log(this);
                    alert(imageSelector.attr("imgwidth") + "/" + imageSelector.attr("imgheight"))
                });

                // =========================================================================
                // Add extra STYLE to wrapping div if needed

                var styleString = buildStyleStringForImg(
                        this, unit, disallowNegativeMargin, imageWrapperSelector, width, height
                        );
                if (styleString) {
                    imageSelector.attr("style", styleString);
                }

                // End of STYLE
                // =========================================================================
            }
        };
        myImage.src = imagePath;
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
            unit.display(unit.disallowNegativeMargin);
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
        var id = "unit-img-" + this.id;
        var idString = this.id ? "id='" + id + "'" : "";
        var imgName = "/img/critter/all/" + this.sex + this.critter + this._action + "_" + this._dir;
        var randomString = "?" + rand(100000, 999999);
        var imagePath = imgName + ".gif" + randomString;

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
//        this.marginTop = 60 + $("#" + id).height() * -1;
//        this.marginTop = 15;
//        if (this.dirTowardNorth()) {
//        }

        // =========================================================================
        // Style
//        var styleString = "";
//        if (this.marginLeft) {
//            styleString += "margin-left:" + this.marginLeft + "px; "
//        }
//        if (this.marginTop) {
//            styleString += "margin-top:" + this.marginTop + "px; "
//        }

//        return "<img " + idString + " src='" + imgName + ".gif" + randomString + "' style='" + style + "' />";
//        var imageElement = "<img " + idString + " src='" + imagePath + "' style='" + style + "' />";
        var imageElement = "<img " + idString + " src='" + imagePath + "' />";
        return {"imageElement": imageElement, "imagePath": imagePath};
//        return {"imageElement": imageElement, "imagePath": imagePath, "style": styleString};
    };

    this.dirTowardEast = function () {
        return [DIR_E, DIR_SE, DIR_NE].indexOf(this._dir) != -1;
    };

    this.dirTowardWest = function () {
        return [DIR_W, DIR_NW, DIR_SW].indexOf(this._dir) != -1;
    };

    this.dirTowardNorth = function () {
        return [DIR_NW, DIR_NE].indexOf(this._dir) != -1;
    };

    this.dirTowardSouth = function () {
        return [DIR_SW, DIR_SE].indexOf(this._dir) != -1;
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

function buildStyleStringForImg(image, unit, disallowNegativeMargin, imageWrapperSelector, width, height) {
    var styleString = "";

    if (!disallowNegativeMargin) {
        image.marginLeft = -width / 2;
        image.marginTop = -height / 2;
    }
    else {
        image.marginLeft = imageWrapperSelector.width() / 2 - width / 2;
        image.marginTop = imageWrapperSelector.height() / 2 - height / 2;
    }

    if (unit._action === SPEAR_EQUIP || unit._action === SPEAR_UNEQUIP) {
//        image.marginTop -= 18;
//        image.marginLeft += 15;
        image.marginTop -= 18;
        image.marginLeft -= 17;
    }

    if (image.marginLeft) {
        styleString += "margin-left:" + image.marginLeft + "px; "
    }
    if (image.marginTop) {
        styleString += "margin-top:" + image.marginTop + "px; "
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
TREE = "";
// =========================================================================
// Sex
MALE = "nm";
FEMALE = "nf";

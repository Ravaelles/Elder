var allUnits = [];

var numOfImages = [];
numOfImages['grass'] = 5;
numOfImages['misc'] = 5;
numOfImages['tree'] = 6;

/**
 * This class represents animated unit/sprite/type to be displayed in the browser.
 * It's possible to change unit and animate it using animate() function. Commands can be chained like:
 * <p>var unit = new Unit(json).create()</p>
 *
 * Unit is identified by:
 * - sex - MALE/FEMALE
 * - dir - direction unit is facing - DIR_E, DIR_W, DIR_SE, DIR_SW, DIR_NE, DIR_NW 0
 * - action - currently executed action - choose one of many constans prefixed ACTION_, SPEAR_ etc
 * - type - Fallout identifier of the type in the gif, use constants lik WARRIOR_MALE, WARRIOR_FEMALE etc
 *
 * @param string json json string that will be used to create object
 * @returns Unit
 */
function Unit(json) {

    this._id = null; // Unique identifier for the unit
    this._sex = null; // Sex of this unit, use MALE or FEMALE
    this._action = null; // Curenntly executed action, use ACTION_* and others
    this._dir = null; // Direction unit is facing, use DIR_*
    this._type = null; // Type of this unit e.g. WARRIOR_MALE, WARRIOR_FEMALE

    this.staticImageDisplayMode = false;
    this.marginLeft = 0;
    this.marginTop = 0;

    this.positionPX = 0; // Position X in pixels
    this.positionPY = 0; // Position Y in pixels

    this._lastAnimationStarted = 0;

    // =========================================================================
    // Constructor

    this.constructor = function (json) {
        var parameters;
        if (typeof json === 'string') {
            parameters = JSON.parse(json);
        }
        else {
            parameters = json;
        }

        this._id = parameters['id'] ? parameters['id'] : __firstFreeUnitId++;
        this._sex = parameters['sex'] ? ("n" + parameters['sex'].toLowerCase()) : MALE;
        this._action = parameters['action'] ? parameters['action'] : ACTION_IDLE;
        this._dir = parameters['dir'] ? parameters['dir'] : DIR_SE;
        this._type = parameters['type'];

        if (!this._type) {
            console.log("Empty unit type for unit:");
            console.log(this);
            alert("Empty unit type passed for new unit");
        }

        allUnits[this._id] = this;
    };
    this.constructor(json);

    // =========================================================================
    // Display

    this.display = function (staticImageDisplayMode) {
        this.staticImageDisplayMode = staticImageDisplayMode;

        var imgObject = this.createImageElement();
        var imageElement = imgObject['imageElement'];
        var imagePath = imgObject['imagePath'];

        // =========================================================================
        // Create wrapper for the image if needed

        if (!this.staticImageDisplayMode) {
            this.createImageWrapper();
        }

        // =========================================================================

        var imageObject = new Image();
        imageObject.unitId = this._id;
        imageObject.unit = this;
        imageObject.imageIsLoaded = false;

        // Define image onload callback
        imageObject.onload = function (event) {
            if (this.imageIsLoaded) {
                return;
            }
            else {
                var unit = this.unit;
                this.imageIsLoaded = true;
                this.src = imagePath;
                var width = this.width;
                var height = this.height;

                var imageWrapperSelector = $("#unit-wrapper-" + this.unitId);

                // Add ready <img src=> element to the div wrapper, thus displaying the animation
                imageWrapperSelector.html(imageElement);

                // Assign current image dimensions to the image element
                var imageSelector = $("#unit-img-" + this.unitId);
                imageSelector.attr({"imgwidth": width, "imgheight": height});

                // =========================================================================
                // Add extra STYLE to wrapping div if needed

                var styleString = buildStyleStringForImg(
                        this, unit, staticImageDisplayMode, imageWrapperSelector, width, height
                        );
                if (styleString) {
                    imageSelector.attr("style", styleString);
                }

            }
        };

        // Assign image url
        imageObject.src = imagePath;

        return this;
    };

    // =========================================================================
    // Animation

    this.animate = function (options, afterTime) {
        if (!afterTime) {
            afterTime = 0;
        }

        var unit = this;
        setTimeout(function () {
            unit.handleOptions(options);
            unit.display(unit.staticImageDisplayMode);
        }, afterTime);

        this._lastAnimationStarted += afterTime;

        return this;
    };

    this.nextAnimate = function (options, afterTime) {
        return this.animate(options, this._lastAnimationStarted + afterTime);
    };

    // Walk

    this.walk = function (options, afterTime) {
//        if (!afterTime) {
//            afterTime = 800;
//        }
        var walkTime = 800;

        // =========================================================================

        var unit = this;

        setTimeout(function () {
            unit.handleOptions(options);
            unit.animate({action: ACTION_WALK}, 0);

            setTimeout(function () {
//                unit.positionPX += dx;
//                unit.positionPY += dy;
                unit.handleWalkPositionChange();
                unit._action = ACTION_IDLE;
                unit.display();
            }, walkTime, unit);
        }, afterTime);

        return this;
    };

    this.handleWalkPositionChange = function () {
        var fullStep = 82;
        var halfStep = 38;

        var dx = 0;
        var dy = 0;

        if (this._dir === DIR_E) {
            dx += fullStep;
        }
        else if (this._dir === DIR_W) {
            dx -= fullStep;
        }
        else if (this._dir === DIR_SE) {
            dx += halfStep;
            dy += halfStep;
        }
        else if (this._dir === DIR_NW) {
            dx -= halfStep;
            dy -= halfStep;
        }

        this.positionPX += dx;
        this.positionPY += dy;

        return this;
    };

    // =========================================================================
    // Positioning

    this.positionRandomly = function () {
        this.positionPX = rand(0, engineView.width);
        this.positionPY = rand(0, engineView.height);
        return this;
    };

    this.position = function (x, y) {
        if (!x && !y) {
            return {x: this.positionPX, y: this.positionPY};
        }
        else {
            this.positionPX = x;
            this.positionPY = y;
            return this;
        }
    };

    // =========================================================================
    // HTML creation

    this.createImageElement = function () {
        var id = "unit-img-" + this._id;
        var idString = this._id ? "id='" + id + "'" : "";

        // Animated image
        if (!this.isStaticImage()) {
            var imgName = "/img/critter/all/" + this._sex + this._type + this._action + "_" + this._dir;
            var randomString = "?" + rand(100000, 999999);
            var imagePath = imgName + ".gif" + randomString;
        }

        // Static image
        else {
            var natureGroupName = this._type.substring(7);
            var imgName = "/img/nature/" + natureGroupName + "/" + rand(1, numOfImages[natureGroupName]);
            var imagePath = imgName + ".png";
        }

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
        // Response contains various elements that can be needed, include them all

        var imageElement = "<img " + idString + " src='" + imagePath + "' />";
        return {"imageElement": imageElement, "imagePath": imagePath};
    };

    // =========================================================================
    // Low-level methods

    this.createImageWrapper = function () {
        $("#canvas").append("<div class='engine-unit' id='unit-wrapper-" + this._id + "'></div>");
    };

    this.handleOptions = function (options) {
        if (options) {
            if (typeof options.action != 'undefined') {
                this._action = options.action;
            }
            if (typeof options.sex != 'undefined') {
                this._sex = options.sex;
            }
            if (typeof options.dir != 'undefined') {
                this._dir = options.dir;
            }
            if (typeof options.type != 'undefined') {
                this._type = options.type;
            }
        }
        return this;
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

    this.isStaticImage = function () {
        return this._type != null && stringStartsWith(this._type, "nature_");
    };

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

__firstFreeUnitId = 100;

// =========================================================================

function buildStyleStringForImg(image, unit, staticImageMode, imageWrapperSelector, width, height) {
    var styleString = "";

    // =========================================================================
    // Handle static mode (just ui animation) or regular, engine mode
    if (staticImageMode) {
        image.marginLeft = imageWrapperSelector.width() / 2 - width / 2;
        image.marginTop = imageWrapperSelector.height() / 2 - height / 2;
    }
    else {
        image.marginLeft = -width / 2;
        image.marginTop = -height;

        // =========================================================================
        // Include direction factor
        if (unit._action === ACTION_WALK) {
            var walkFactor = 0.4;
            var diagonalWalkFactor = 0.32;
            if (unit._dir === DIR_E) {
                image.marginLeft += width * walkFactor;
            }
            else if (unit._dir === DIR_W) {
                image.marginLeft -= width * walkFactor;
            }
            else if (unit._dir === DIR_SE) {
                image.marginLeft += width * diagonalWalkFactor;
                image.marginTop += height * diagonalWalkFactor;
            }
            else if (unit._dir === DIR_NW) {
                image.marginLeft -= width * diagonalWalkFactor;
                image.marginTop -= height * diagonalWalkFactor;
            }
        }
    }

    if (unit._action === SPEAR_EQUIP || unit._action === SPEAR_UNEQUIP) {
//        image.marginTop -= 18;
        //        image.marginLeft += 15;
        image.marginTop -= 18;
        image.marginLeft -= 17;
    }

    // =========================================================================
    // Include position factor
    image.marginLeft += unit.positionPX;
    image.marginTop += unit.positionPY;

    // =========================================================================
    // Handle margin
    if (image.marginLeft) {
        styleString += "margin-left:" + image.marginLeft + "px; "
    }
    if (image.marginTop) {
        styleString += "margin-top:" + image.marginTop + "px; "
        styleString += "z-index: " + image.marginTop + "; "
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
NATURE_TREE = "nature_tree";
NATURE_GRASS = "nature_grass";
// =========================================================================
// Sex
MALE = "nm";
FEMALE = "nf";

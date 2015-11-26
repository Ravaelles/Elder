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

    this._lastAnimationEndsAt = 0;
    this._imageSelector = null;

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
                unit._imageSelector = imageSelector;
                imageSelector.attr({"imgwidth": width, "imgheight": height});
                imageSelector.css('z-index', unit.positionPY);

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

    this._queueAnimations = [];

    this.queueAnimation = function (options, delay, animationLength) {
        var startAnimatingUnitAfterTime;
        var lastAnimationEndedAgo = this.timeSinceLastAnimationEndedAgo();
        var canStartAnimationNow = lastAnimationEndedAgo >= 0;

        if (!animationLength) {
            animationLength = 800;
        }
        if (!delay) {
            delay = 0;
        }

        // =========================================================================
        // Define time when next animation could be potentially executed

        if (canStartAnimationNow) {
            startAnimatingUnitAfterTime = 0;
            this._lastAnimationEndsAt = this.timeNow() + delay + animationLength;
        }
        else {
            startAnimatingUnitAfterTime = -lastAnimationEndedAgo;
            this._lastAnimationEndsAt += delay + startAnimatingUnitAfterTime + animationLength;
        }

        // =========================================================================
        // Either run an animation now or queue it

        // Run now
        if (canStartAnimationNow && this._queueAnimations.length == 0) {
            this._runAnimationNow(options, delay, animationLength);
        }

        // Doing something else now, so queue it
        else {
            var animationObject = {
                'options': options,
                'animationLength': animationLength,
                'delay': delay,
            };
            this._queueAnimations.push(animationObject);
        }

        return this;
    };

    this._runAnimationNow = function (options, delay, animationLength) {
        var unit = this;

        setTimeout(function () {

            // Run callback before the start of animation
            var callbackAnimationAfterStart = options['callbackAnimationAfterStart'];
            if (callbackAnimationAfterStart) {
                callbackAnimationAfterStart(unit, options);
            }

            unit._animate(options);

            // =========================================================================

            setTimeout(function () {

                // Run callback at the end of animation
                var callbackAnimationEnded = options['callbackAnimationEnded'];
                if (callbackAnimationEnded) {
                    callbackAnimationEnded(unit);
                }

                // Run next animation in enqueued
                unit.runNextQueuedAnimationIfNeeded();

            }, animationLength, unit);
        }, delay);

        return this;
    };

    this.runNextQueuedAnimationIfNeeded = function () {
        var nextAnimation = this._queueAnimations.shift();

        if (nextAnimation !== undefined) {
            var options = nextAnimation['options'];
            var animationLength = nextAnimation['animationLength'];
            var delay = nextAnimation['delay'];
            this._runAnimationNow(options, delay, animationLength);
        }
    };

    this._animate = function (options, afterTime) {
        if (!afterTime) {
            afterTime = 0;
        }
        if (!options) {
            options = [];
        }

        // =========================================================================
        // Animation started callback

        var callbackAnimationBeforeStart = options['callbackAnimationBeforeStart'];
        if (callbackAnimationBeforeStart) {
            callbackAnimationBeforeStart(this);
        }

        // =========================================================================

        var unit = this;
        setTimeout(function () {
            unit.handleOptions(options);
            unit.display(unit.staticImageDisplayMode);
        }, afterTime);

        this._lastAnimationStarted += afterTime;

        return this;
    };

    this.timeSinceLastAnimationEndedAgo = function () {
        return this.timeNow() - this._lastAnimationEndsAt;
    };

    this.timeNow = function () {
        return (new Date()).getTime();
    };

    // =========================================================================
    // Animation generic

    this.animation = function (options, delay, animationLength) {
        if (!options) {
            options = {};
        }
        if (!animationLength) {
            animationLength = 1700;
        }
        if (!delay || delay < 0) {
            delay = 0;
        }

        this.queueAnimation(options, delay, animationLength);

        return this;
    };

    // Walk

    this.walk = function (options, delay) {
        var walkAnimationTimespan = 800;
        var lastAnimationEnded = this.timeSinceLastAnimationEndedAgo();
        var startAnimatingUnitAfterTime;

        if (!delay) {
            delay = 0;
        }
        if (!options) {
            options = [];
        }

        // =========================================================================

        options['callbackAnimationAfterStart'] = function (unit, options) {
            unit.convertActionToWalk();
        };

        options['callbackAnimationEnded'] = function (unit) {
            unit.handleWalkPositionChange();
            unit.convertActionToIdle();
            unit._animate();
        };

        this.queueAnimation(options, delay, walkAnimationTimespan);

        return this;
    };

    this.convertActionToWalk = function () {
        this._action = this._action.replaceAt(1, "b");
        return this;
    };

    this.convertActionToIdle = function () {
        this._action = this._action.replaceAt(1, "a");
        return this;
    };

    this.handleWalkPositionChange = function () {
        var fullStep = 82;
        var halfStep = 36;

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
        else if (this._dir === DIR_SW) {
            dx -= halfStep;
            dy += halfStep;
        }
        else if (this._dir === DIR_NW) {
            dx -= halfStep;
            dy -= halfStep;
        }
        else if (this._dir === DIR_NE) {
            dx += halfStep;
            dy -= halfStep;
        }

        this.positionPX += dx;
        this.positionPY += dy;

        return this;
    };

    // Equip weapons

    this.equipWeapon = function (weaponName, delay) {
        var options = {action: window[weaponName + "_EQUIP"]};
        options['callbackAnimationEnded'] = function (unit) {
            unit._action = window[weaponName + "_IDLE"];
        };

        if (weaponName === WEAPON_SPEAR) {
            var animationLength = 1300;
        }
        else {
            var animationLength = 1300;
        }

        this.queueAnimation(options, delay, animationLength);
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
        var imgClass = "";

        // Animated image
        if (!this.isStaticImage()) {
            var imgName = "/img/critter/all/" + this._sex + this._type + this._action + "_" + this._dir;
            var randomString = "?" + rand(100000, 999999);
            var imagePath = imgName + ".gif" + randomString;
            imgClass = "unit-alive";
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

        var imageElement = "<img " + idString + " class='" + imgClass + "' src='" + imagePath + "' />";
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

    this.isActionWalk = function () {
        return this._action.charAt(1) === "b";
    };

    this.isActionWithWeapon = function (weaponName) {
        if (weaponName === WEAPON_SPEAR) {
            weaponLetter = "g";
        }
        else {
            weaponLetter = "a"; // Generic actions
        }
        return this._action.charAt(0) === weaponLetter.charAt(0);
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

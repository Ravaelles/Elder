function WorldmapObject(options) {

    this._id = null; // Unique identifier for the worldmap object
    this._x = null; //
    this._y = null; //
    this._x2 = null; //
    this._y2 = null; //
    this._htmlElements = []; //

    // =========================================================================
    // Constructor

    this.constructor = function (options) {
        this._id = __firstFreeWorldmapObjectId++;

        for (var fieldName in options) {
            var value = options[fieldName];
            fieldName = "_" + fieldName;
            this.fieldName = value;
        }
    };
    this.constructor(options);

    this.getId = function () {
        return this._id;
    };

    // === HTML elements ======================================================================

    this.addHtmlElement = function (htmlElement) {
        var htmlElementId = htmlElement.getId();
        this._htmlElements[htmlElementId] = htmlElement;
        return this;
    };

    this.getHtmlElements = function () {
        return this._htmlElements.slice();
    };

    // === Coordinates ======================================================================

    this.setCoordinates = function (x, y) {
        this._x = x;
        this._y = y;
        return this;
    };

    this.setEndCoordinates = function (x2, y2) {
        this._x2 = x2;
        this._y2 = y2;
        return this;
    };

    this.getCoordinates = function () {
        return {'x': this._x, 'y': this._y};
    };

    this.translate = function (dx, dy) {
        this._x += dx;
        this._y += dy;

        for (var htmlElementId in this._htmlElements) {
            var htmlElementObject = this._htmlElements[htmlElementId];
            htmlElementObject.translate(dx, dy);
        }
    };

}

// =========================================================================

__firstFreeWorldmapObjectId = 1;
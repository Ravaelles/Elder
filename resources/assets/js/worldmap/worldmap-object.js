function WorldmapObject(options) {

    this._id = null; // Unique identifier for the worldmap object
    this._x = null; //
    this._y = null; //
    this._htmlElements = []; //

    // =========================================================================
    // Constructor

    this.constructor = function (options) {
        this._id = __firstFreeWorldmapObjectId++;

        for (var fieldName in options) {
            var value = options[fieldName];
            fieldName = "_" + fieldName;
            this.fieldName = value;
//            console.log(fieldName + " / " + value);
        }
    };
    this.constructor(options);

    this.getId = function () {
        return this._id;
    };

    // =========================================================================
    // Assign fields

    this.setCoordinates = function (x, y) {
        this._x = x;
        this._y = y;
        return this;
    };

    this.getCoordinates = function () {
        return {'x': this._x, 'y': this._y};
    };

    this.addHtmlElement = function (htmlElement) {
        this._htmlElements.push(htmlElement);
        return this;
    };

    this.getHtmlElements = function () {
        return this._htmlElements.slice();
    };

}

// =========================================================================

__firstFreeWorldmapObjectId = 1;
function MapObject(mapObject) {

    this.rawMapObject = null; // Array object passed from PHP

    this._width = null;
    this._height = null;

    // =========================================================================

    this.constructor = function (mapObject) {
        this.rawMapObject = mapObject;
    };
    this.constructor(mapObject);

    // =========================================================================

    this.createElement = function () {
        var rawMapObject = this.rawMapObject;

        var type = rawMapObject['type'];
        var canvasX = this.getCanvasX();
        var canvasY = this.getCanvasY();

        var style = 'top:' + canvasY + 'px; left:' + canvasX + 'px; width:' + getTileSize() + 'px';

        var html = '<img class="map-object map-object-' + type + '" style="' + style
                + '" src="' + rawMapObject['image'] + '">'

        return html;
    };

    // =========================================================================

    /*
     * Returns width of image representing this map object according to the current zoom.
     */
    this.getWidth = function () {
        if (this._height === null) {
            var scaleRatio = getTileSize() / this.getRawWidth();
            this._width = this.getRawWidth() * scaleRatio;
        }
        return this._width;
    };

    /*
     * Returns height of image representing this map object according to the current zoom.
     */
    this.getHeight = function () {
        if (this._height === null) {
            var scaleRatio = getTileSize() / this.getRawWidth();
            this._height = this.getRawHeight() * scaleRatio;
        }
        return this._height;
    };

    this.getCanvasX = function () {
        return ((this.rawMapObject['TX'] + 0.5 + this.rawMapObject['dTX']) * getTileSize())
                - getTileSize() / 2;
        //    return ((mapObject['TX'] + 0.5 + mapObject['dTX']) * getTileSize()) - mapObject['width'] / 2;
    };

    this.getCanvasY = function () {
        return ((this.rawMapObject['TY'] + 0.5 + this.rawMapObject['dTY']) * getTileSize())
                - this.getHeight() / 2;
        //    return ((mapObject['TY'] + 0.5 + mapObject['dTY']) * getTileSize());
    };

    // =========================================================================

    this.getRawType = function () {
        return this.rawMapObject.type;
    };

    this.getRawWidth = function () {
        return this.rawMapObject['width'];
    };

    this.getRawHeight = function () {
        return this.rawMapObject['height'];
    };

}
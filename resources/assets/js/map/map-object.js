function MapObject(mapObject) {

    this.rawMapObject = null; // Array object passed from PHP

    this._width = null;
    this._height = null;
    this._sizeModifier = 1;

    // =========================================================================

    this.constructor = function (mapObject) {
        this.rawMapObject = mapObject;
    };

    // =========================================================================
    // Getters

    /*
     * Returns width of image representing this map object according to the current zoom.
     */
    this.getWidth = function () {
        if (this._width === null) {
            this.defineWidthAndHeight();
        }
        return this._width;
    };

    /*
     * Returns height of image representing this map object according to the current zoom.
     */
    this.getHeight = function () {
        if (this._height === null) {
            this.defineWidthAndHeight();
        }
        return this._height;
    };

    this.defineWidthAndHeight = function () {
        var scaleRatio = getTileSize() / this.getRawWidth();
        this._sizeModifier = this.getSizeModifier();
        this._width = this.getRawWidth() * scaleRatio * this._sizeModifier;
        this._height = this.getRawHeight() * scaleRatio * this._sizeModifier;
    };

    this.getCanvasX = function () {
        return ((this.rawMapObject['TX'] + 0.5 + this.rawMapObject['dTX']) * getTileSize())
                - getTileSize() / 2;
        //    return ((mapObject['TX'] + 0.5 + mapObject['dTX']) * getTileSize()) - mapObject['width'] / 2;
    };

    this.getCanvasY = function () {
        var centerInTileModifier = (this.isVerticalAlignofImageToTheBottom() ?
                (-this.getHeight()) : (-this.getHeight() / 2));
        return ((this.rawMapObject['TY'] + 0.5 + this.rawMapObject['dTY']) * getTileSize())
                + centerInTileModifier;
        //    return ((mapObject['TY'] + 0.5 + mapObject['dTY']) * getTileSize());
    };

    // =========================================================================
    // Create element

    this.createElement = function () {
        var rawMapObject = this.rawMapObject;

        var type = rawMapObject['type'];
        var canvasX = this.getCanvasX();
        var canvasY = this.getCanvasY();
        var zIndex = this.calculateZIndex();
        var width = getTileSize() * this.getSizeModifier();

        var style = 'z-index:' + zIndex + '; top:' + canvasY + 'px; left:' + canvasX + 'px; '
                + 'width:' + width + 'px';

        var html = '<img class="map-object map-object-' + type + '" style="' + style
                + '" src="' + rawMapObject['image'] + '">'

        return html;
    };

    this.calculateZIndex = function () {
        var zIndex = (this.rawMapObject['TY'] + this.rawMapObject['dTY'] + 2) * 10;
        if (this.getRawType() === 'tree') {
            zIndex += 1000;
        }
        return zIndex;
    };

    this.getSizeModifier = function () {
        var size = this.getRawType() === 'tree' ? 0.5 : 1;
        return size;
    };

    // =========================================================================
    // Raw MapObject getters

    this.getRawType = function () {
        return this.rawMapObject.type;
    };

    this.getRawWidth = function () {
        return this.rawMapObject['width'];
    };

    this.getRawHeight = function () {
        return this.rawMapObject['height'];
    };

    this.isVerticalAlignofImageToTheBottom = function () {
        return this.rawMapObject['vertical-align'] === 'bottom';
    };

    // =========================================================================

    this.constructor(mapObject);

}
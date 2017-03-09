class MapObject {

    //private rawObject = null; // Array object passed from PHP
    //private _width = null;
    //private _height = null;
    //private _sizeModifier = 1;

    // =========================================================================

    constructor(rawMapObjectParam) {
        this._width = null;
        this._height = null;
        this._sizeModifier = 1;
        this._rawMapObject = rawMapObjectParam;
    }

    // =========================================================================
    // Getters

    /*
     * Returns width of image representing this map object according to the current zoom.
     */
    getWidth() {
        if (this._width === null) {
            this.defineWidthAndHeight();
        }
        return this._width;
    }

    /*
     * Returns height of image representing this map object according to the current zoom.
     */
    getHeight() {
        if (this._height === null) {
            this.defineWidthAndHeight();
        }
        return this._height;
    }

    defineWidthAndHeight() {
        var scaleRatio = getTileSize() / this.getRawWidth();
        this._sizeModifier = this.getSizeModifier();
        this._width = this.getRawWidth() * scaleRatio * this._sizeModifier;
        this._height = this.getRawHeight() * scaleRatio * this._sizeModifier;
    }

    getCanvasX() {
        console.log(this.rawMapObject);
        return ((this.rawMapObject('TX') + 0.5 + this.rawMapObject('dTX')) * getTileSize())
            - getTileSize() / 2;
        //    return ((mapObject['TX'] + 0.5 + mapObject['dTX']) * getTileSize()) - mapObject['width'] / 2;
    }

    getCanvasY() {
        var centerInTileModifier = (this.isVerticalAlignofImageToTheBottom() ?
            (-this.getHeight()) : (-this.getHeight() / 2));
        return ((this.rawMapObject('TY') + 0.5 + this.rawMapObject('dTY')) * getTileSize())
            + centerInTileModifier;
        //    return ((mapObject['TY'] + 0.5 + mapObject['dTY']) * getTileSize());
    }

    // =========================================================================
    // Create element

    createElement() {
        var type = this.getRawMapObject()['type'];

        var canvasX = this.getCanvasX();
        var canvasY = this.getCanvasY();
        var zIndex = this.calculateZIndex();
        var width = getTileSize() * this.getSizeModifier();

        var style = 'z-index:' + zIndex + '; top:' + canvasY + 'px; left:' + canvasX + 'px; '
            + 'width:' + width + 'px';

        var html = '<img class="map-object map-object-' + type + '" style="' + style
            + '" src="' + this.getRawMapObject()['image'] + '">';

        return html;
    }

    calculateZIndex() {
        var zIndex = (this.rawMapObject['TY'] + this.rawMapObject['dTY'] + 2) * 10;
        if (this.getRawType() === 'tree') {
            zIndex += 1000;
        }
        return zIndex;
    }

    getSizeModifier() {
        return this.getRawType() === 'tree' ? 0.5 : 1;
    }

    // =========================================================================
    // Raw MapObject getters

    rawMapObject(fieldToGetOrNull) {
        if (fieldToGetOrNull !== null) {
            return this._rawMapObject[fieldToGetOrNull];
        }
        else {
            return this._rawMapObject;
        }
    }

    // set rawObject(value) {
    //     this._rawMapObject = value;
    // }

    getRawMapObject() {
        return this._rawMapObject;
    }
    getRawType() {
        return this._rawMapObject.type;
    }

    getRawWidth() {
        return this._rawMapObject['width'];
    }

    getRawHeight() {
        return this._rawMapObject['height'];
    }

    isVerticalAlignofImageToTheBottom() {
        return this._rawMapObject['vertical-align'] === 'bottom';
    }

}
WENGINE_DEFAULT_LINE_WIDTH = 1;

// =========================================================================

window.initQueue.push(function () {
    setTimeout(function () {
        var rect = getWorldmapViewRectangle();
        var TEMP = 30;

        rect['x'] += TEMP;
        rect['y'] += TEMP;
        rect['width'] -= 2 * TEMP + WENGINE_DEFAULT_LINE_WIDTH;
        rect['height'] -= 2 * TEMP + WENGINE_DEFAULT_LINE_WIDTH;
        rect['width'] /= getWorldmapZoom();
        rect['height'] /= getWorldmapZoom();

//        WEngine_paintRectangleFromArray(rect, {'background-color': 'transparent'});
        paintTest();
    }, 160);
});

// =========================================================================

var testLineX1;
var testLineY1;
var testLineX2;
var testLineY2;
function paintTest() {
    testLineX1 = _WORLDMAP_IMAGE_INITIAL_X + 300;
    testLineY1 = _WORLDMAP_IMAGE_INITIAL_Y + 400;
    testLineX2 = testLineX1;
    testLineY2 = testLineY1;

    var line = WEngine_paintLine(testLineX1, testLineY1, testLineX2, testLineY2);
    console.log(line);

    setTimeout(function () {
        testLineX2
    }, 100);
}

// === Public ======================================================================

function WEngine_paintLine(x1, y1, x2, y2, options, worldmapObject) {
    //    console.log("Line: " + x1 + "," + y1 + " / " + x2 + "," + y2);
    canvasCoords = getCanvasCoordinatesFromMapCoordinates(x1, y1);
    x1 = canvasCoords['canvasX'];
    y1 = canvasCoords['canvasY'];
    canvasCoords = getCanvasCoordinatesFromMapCoordinates(x2, y2);
    x2 = canvasCoords['canvasX'];
    y2 = canvasCoords['canvasY'];

    var line = _WEngine_getLine(x1, y1, x2, y2, options);

    // =========================================================================
    // Worldmap object related - automatically create only if no worldmapObject was passed
    if (isUndefined(worldmapObject)) {
        worldmapObject = new WorldmapObject();
        worldmapObject.setCoordinates(x1, y1);
        worldmapObject.setEndCoordinates(x2, y2);
        worldmapObject.addHtmlElement(line);
        addWorldmapObject(worldmapObject);

        // Return WORLDMAP OBJECT
        return worldmapObject;
    }

    // If passed existing WorldmapObject return HTML ELEMENT
    else {
        return line;
    }
}

function WEngine_paintRectangleFromArray(array, options) {
    return WEngine_paintRectangle(
            array['x'], array['y'], array['x'] + array['width'], array['y'] + array['height'], options
            );
}

function WEngine_paintRectangle(x1, y1, x2, y2, options) {
    var worldmapObject = new WorldmapObject();
    worldmapObject.setCoordinates(x1, y1);
    worldmapObject.setEndCoordinates(x2, y2);

    worldmapObject.addHtmlElement(WEngine_paintLine(x1, y1, x2, y1, options, worldmapObject)); // Horiz Top
    worldmapObject.addHtmlElement(WEngine_paintLine(x1, y2, x2, y2, options, worldmapObject)); // Horiz Bottom
    worldmapObject.addHtmlElement(WEngine_paintLine(x1, y1, x1, y2, options, worldmapObject)); // Vert Left
    worldmapObject.addHtmlElement(WEngine_paintLine(x2, y1, x2, y2, options, worldmapObject)); // Vert Right

    addWorldmapObject(worldmapObject);
    return worldmapObject;
}

// === Private ======================================================================

function _WEngine_getLine(x1, y1, x2, y2, options) {
    var a = x1 - x2,
            b = y1 - y2,
            c = Math.sqrt(a * a + b * b);

    var sx = (x1 + x2) / 2,
            sy = (y1 + y2) / 2;

    var x = sx - c / 2,
            y = sy;

    var alpha = Math.PI - Math.atan2(-b, a);

    return _WEngine_getLine_element(x, y, c, alpha, options);
}

// === Html elements ======================================================================

//function _WEngine_getLine_element(x, y, length, angle, options) {
//    var line = document.createElement("div");
//    var styles = 'border: ' + WENGINE_DEFAULT_LINE_WIDTH + 'px dashed red; '
//            + 'width: ' + length + 'px; '
//            + 'height: 0px; '
//            + '-moz-transform: rotate(' + angle + 'rad); '
//            + '-webkit-transform: rotate(' + angle + 'rad); '
//            + '-o-transform: rotate(' + angle + 'rad); '
//            + '-ms-transform: rotate(' + angle + 'rad); '
//            + 'position: absolute; '
//            + 'top: ' + y + 'px; '
//            + 'left: ' + x + 'px; ';
//
//    if (isDefined(options)) {
//        for (var option in options) {
//            styles += option + ':' + options[option] + ';';
//        }
//    }
//
//    line.setAttribute('style', styles);
//    _WEngine_assignIdToHtmlElement(line);
//    return line;
//}
function _WEngine_getLine_element(x, y, length, angle, options) {
    var lineHtmlElement = new HtmlElement(x, y);
    var style = 'border: ' + WENGINE_DEFAULT_LINE_WIDTH + 'px dashed red; '
            + 'width: ' + length + 'px; '
            + 'height: 0px; '
            + '-moz-transform: rotate(' + angle + 'rad); '
            + '-webkit-transform: rotate(' + angle + 'rad); '
            + '-o-transform: rotate(' + angle + 'rad); '
            + '-ms-transform: rotate(' + angle + 'rad); '
            + 'position: absolute; ';
//            + 'top: ' + y + 'px; '
//            + 'left: ' + x + 'px; ';;

    if (isDefined(options)) {
        for (var option in options) {
            style += option + ':' + options[option] + ';';
        }
    }

    lineHtmlElement.setStyle(style);
    return lineHtmlElement;
}

// =========================================================================

//function _WEngine_assignIdToHtmlElement(element) {
//    __lastHtmlElementId = (__firstFreeWorldmapObjectHtmlElementId++);
//    element.setAttribute('id', 'html-element-' + __lastHtmlElementId);
//    return __lastHtmlElementId;
//}

__firstFreeWorldmapObjectHtmlElementId = 100;
//__lastHtmlElementId = null;
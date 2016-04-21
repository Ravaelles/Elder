WENGINE_DEFAULT_LINE_WIDTH = 2;

// =========================================================================

window.initQueue.push(function () {
    setTimeout(function () {
//        getWorldmap().append(createLine(300, 300, 500, 500));
//        getWorldmap().append(createLine(300, 300, 300, 500));
//        getWorldmap().append(createLine(300, 300, 400, 300));

        var rect = jQuery.extend({}, currentWorldmapView);
        var TEMP = 2;
        rect['x'] += TEMP;
        rect['y'] += TEMP;
        rect['width'] -= 2 * TEMP + WENGINE_DEFAULT_LINE_WIDTH;
        rect['height'] -= 2 * TEMP + WENGINE_DEFAULT_LINE_WIDTH;
        rect['width'] /= zoom;
        rect['height'] /= zoom;

        WEngine_paintRectangleFromArray(rect, {'background-color': 'yellow'});
    }, 160);
});

// === Public ======================================================================

function WEngine_paintLine(x1, y1, x2, y2, options) {
    //    console.log("Line: " + x1 + "," + y1 + " / " + x2 + "," + y2);

    canvasCoords = getCanvasCoordinatesFromMapCoordinates(x1, y1);
    x1 = canvasCoords['canvasX'];
    y1 = canvasCoords['canvasY'];
    canvasCoords = getCanvasCoordinatesFromMapCoordinates(x2, y2);
    x2 = canvasCoords['canvasX'];
    y2 = canvasCoords['canvasY'];

    var line = _WEngine_getLine(x1, y1, x2, y2, options);
    getWorldmap().append(line);
}

function WEngine_paintRectangleFromArray(array, options) {
    return WEngine_paintRectangle(
            array['x'], array['y'], array['x'] + array['width'], array['y'] + array['height'], options
            );
}

function WEngine_paintRectangle(x1, y1, x2, y2, options) {
    WEngine_paintLine(x1, y1, x2, y1, options); // Horizontal Top
    WEngine_paintLine(x1, y2, x2, y2, options); // Horizontal Bottom
    WEngine_paintLine(x1, y1, x1, y2, options); // Vertical Left
    WEngine_paintLine(x2, y1, x2, y2, options); // Vertical Right
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

function _WEngine_getLine_element(x, y, length, angle, options) {
    var line = document.createElement("div");
    var styles = 'border: ' + WENGINE_DEFAULT_LINE_WIDTH + 'px dashed red; '
            + 'width: ' + length + 'px; '
            + 'height: 0px; '
            + '-moz-transform: rotate(' + angle + 'rad); '
            + '-webkit-transform: rotate(' + angle + 'rad); '
            + '-o-transform: rotate(' + angle + 'rad); '
            + '-ms-transform: rotate(' + angle + 'rad); '
            + 'position: absolute; '
            + 'top: ' + y + 'px; '
            + 'left: ' + x + 'px; ';

    if (isDefined(options)) {
        for (var option in options) {
            styles += option + ':' + options[option] + ';';
        }
    }

    line.setAttribute('style', styles);
    return line;
}
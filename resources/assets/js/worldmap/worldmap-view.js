var WORLDMAP_IMAGE_INITIAL_WIDTH = 3500;
var WORLDMAP_IMAGE_INITIAL_X = 150;
var WORLDMAP_IMAGE_INITIAL_Y = 100;

var MIN_ZOOM_VALUE = 0.58;
var zoom = 1;
var zoomStep = 150;

var currentWorldmapView = null;
var currentWorldmapImageWidth = null;
var currentWorldmapImageHeight = null;

// Revert zoom
var oldMapImageWidth = null;
var oldZoom = null;

// === Zoom ======================================================================

function initializeWorldmapZoom() {
    initializeWorldmapView();

    getWorldmap().css('background-size', currentWorldmapImageWidth + "px");
    getWorldmap().css('background-position-x', '-' + currentWorldmapView['x'] + 'px');
    getWorldmap().css('background-position-y', '-' + currentWorldmapView['y'] + 'px');

    currentWorldmapImageWidth = WORLDMAP_IMAGE_INITIAL_WIDTH;
    currentWorldmapImageHeight = currentWorldmapImageWidth * WORLDMAP_CANVAS_WIDTH / WORLDMAP_CANVAS_HEIGHT;
    zoom = WORLDMAP_WIDTH / currentWorldmapImageWidth;
}

function initializeWorldmapView() {
    currentWorldmapView = {
        'x': WORLDMAP_IMAGE_INITIAL_X, 'y': WORLDMAP_IMAGE_INITIAL_Y,
        'width': WORLDMAP_CANVAS_WIDTH,
        'height': WORLDMAP_CANVAS_HEIGHT
    };
}

// =========================================================================

function changeZoom(event, isZoomIn) {

    // Remember initial view variables
    oldMapImageWidth = currentWorldmapImageWidth;
    oldZoom = zoom;

    // =========================================================================

    if (isZoomIn) {
        currentWorldmapImageWidth -= zoomStep;
    } else {
        currentWorldmapImageWidth += zoomStep;
    }

    // Recalculate zoom
    zoom = WORLDMAP_WIDTH / currentWorldmapImageWidth;

    // === Revert zoom if too close/far =========================================

    var isZoomTooClose = zoom < MIN_ZOOM_VALUE; // Zoom is TOO BIG, background would be too pixel
    var isZoomTooFar = currentWorldmapImageWidth < WORLDMAP_CANVAS_WIDTH;
    if (isZoomTooClose || isZoomTooFar) {
        return revertZoom();
    }

    // === Adapt zoom or revert if out of bounds ================================

    var viewX2 = currentWorldmapView['x'] + currentWorldmapView['width'];
    var viewY2 = currentWorldmapView['y'] + currentWorldmapView['height'];
    console.log(viewX2 + " / " + WORLDMAP_WIDTH);
    var isZoomOutOfBounds = viewX2 > WORLDMAP_WIDTH;
    if (isZoomOutOfBounds) {
        return revertZoom();
    }

    // =========================================================================

//    console.log("zoom: " + zoom + " / map width: " + currentWorldmapImageWidth);

    // Change image map
    $(".worldmap").css('background-size', currentWorldmapImageWidth + "px");

    // Update view rectangle
    updateViewRectangle();

    // =========================================================================
    // Move every map location and change its size.
    changeZoom_updateMapLocations();
}

function revertZoom() {
    currentWorldmapImageWidth = oldMapImageWidth;
    zoom = oldZoom;
}

// === View ======================================================================

function updateViewRectangle(xOrObject, yOrObject) {

    // If params are defined, it means we need to move by view rectangle [x,y]
    if (isDefined(xOrObject)) {
        var newX, newY;
        if (xOrObject != null) {
            newX = Math.abs(xOrObject);
            newY = Math.abs(yOrObject);
        } else {
            newX = Math.abs(xOrObject['x']);
            newY = Math.abs(yOrObject['y']);
        }

        currentWorldmapView['x'] = newX;
        currentWorldmapView['y'] = newY;
    }

    // Update width and height of view rectangle
    currentWorldmapView['width'] = WORLDMAP_CANVAS_WIDTH / zoom;
    currentWorldmapView['height'] = WORLDMAP_CANVAS_HEIGHT / zoom;
}

function getMapOffsetPixelsX() {
    return currentWorldmapView['x'];
}

function getMapOffsetPixelsY() {
    return currentWorldmapView['y'];
}

// =========================================================================

function changeZoom_updateMapLocations() {

    // Recalculate margin-top for location label
    recalculateWorldmapLocationVariables();

    // Change location and size of every worldmap location
    var mapLocations = $(".worldmap-location");
    $.each(mapLocations, function (index, object) {
        var mapObject = $("#" + object['id']);
        var variableName = mapObject.attr('variableName');
        var variableIndex = mapObject.attr('variableIndex');
        var mapLocationObject = window[variableName][variableIndex];

        // Change size
        mapObject.css('width', WORLDMAP_LOCATION_SIZE + "px");
        mapObject.css('height', WORLDMAP_LOCATION_SIZE + "px");

        // Change X,Y
        var canvasCoordinates = getCanvasCoordinatesFromMapCoordinates(
                mapLocationObject['location']['x'], mapLocationObject['location']['y']
//                mapLocationObject['location']['x'] - WORLDMAP_LOCATION_SIZE / 2,
//                mapLocationObject['location']['y'] - WORLDMAP_LOCATION_SIZE / 2
                );
//        if (index == 0) {
//            console.log("ZOOM:");
//            console.log(canvasCoordinates);
//        }
        mapObject.css('left', canvasCoordinates['canvasX'] - WORLDMAP_LOCATION_SIZE / 2);
        mapObject.css('top', canvasCoordinates['canvasY'] - WORLDMAP_LOCATION_SIZE / 2);
    });

    // Move label
    $(".worldmap-location label").css('margin-top', WORLDMAP_LOCATION_LABEL_MARGIN_TOP + 'px');
}
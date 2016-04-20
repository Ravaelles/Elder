var WORLDMAP_IMAGE_INITIAL_WIDTH = 3500;
var WORLDMAP_INITIAL_VIEW_X = 100;
var WORLDMAP_INITIAL_VIEW_Y = 100;
var MIN_ZOOM_VALUE = 0.58;

var zoom = 1;
var zoomStep = 150;

var currentMapImageWidth = null;
var currentMapImageHeight = null;

// Revert zoom
var oldMapImageWidth = null;
var oldZoom = null;

// === Zoom ======================================================================

function initializeWorldmapZoom() {
    currentMapImageWidth = WORLDMAP_IMAGE_INITIAL_WIDTH;
    currentMapImageHeight = currentMapImageWidth * WORLDMAP_CANVAS_WIDTH / WORLDMAP_CANVAS_HEIGHT;
    zoom = WORLDMAP_WIDTH / currentMapImageWidth;
}

function changeZoom(event, isZoomIn) {

    // Remember initial view variables
    oldMapImageWidth = currentMapImageWidth;
    oldZoom = zoom;

    // =========================================================================

    if (isZoomIn) {
        currentMapImageWidth -= zoomStep;
    } else {
        currentMapImageWidth += zoomStep;
    }

    // Recalculate zoom
    zoom = WORLDMAP_WIDTH / currentMapImageWidth;

    // === Revert zoom if needed ================================================

    var isZoomTooClose = zoom < MIN_ZOOM_VALUE; // Zoom is TOO BIG, background would be too pixel
    var isZoomTooFar = currentMapImageWidth < WORLDMAP_CANVAS_WIDTH;
    if (isZoomTooClose || isZoomTooFar) {
        return revertZoom();
    }

    // =========================================================================

    console.log("zoom: " + zoom + " / map width: " + currentMapImageWidth);

    // Change image map
    $(".worldmap").css('background-size', currentMapImageWidth + "px");

    // Move every map location and change its size.
    changeZoom_updateMapLocation();
}

function revertZoom() {
    currentMapImageWidth = oldMapImageWidth;
    zoom = oldZoom;
}

// === View ======================================================================

function getMapOffsetPixelsX() {
    return -1 * getWorldmap().css('background-position-x').slice(0, -2);
}

function getMapOffsetPixelsY() {
    return -1 * getWorldmap().css('background-position-y').slice(0, -2);
}

// =========================================================================

function changeZoom_updateMapLocation() {

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
//                mapLocationObject['location']['x'], mapLocationObject['location']['y']
                mapLocationObject['location']['x'] - WORLDMAP_LOCATION_SIZE / 2,
                mapLocationObject['location']['y'] - WORLDMAP_LOCATION_SIZE / 2
                );
//        if (index == 0) {
//            console.log("ZOOM:");
//            console.log(canvasCoordinates);
//        }
        mapObject.css('left', canvasCoordinates['canvasX']);
        mapObject.css('top', canvasCoordinates['canvasY']);
    });

    // Move label
    $(".worldmap-location label").css('margin-top', WORLDMAP_LOCATION_LABEL_MARGIN_TOP + 'px');
}
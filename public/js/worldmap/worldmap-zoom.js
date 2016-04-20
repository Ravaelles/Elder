var WORLDMAP_IMAGE_INITIAL_WIDTH = 3500;
var WORLDMAP_INITIAL_VIEW_X = 100;
var WORLDMAP_INITIAL_VIEW_Y = 100;
var MIN_ZOOM_VALUE = 0.58;

var zoom = 1;
var zoomStep = 200;

var currentMapImageWidth = null;
var currentMapImageHeight = null;

// === Zoom ======================================================================

function initializeWorldmapZoom() {
    currentMapImageWidth = WORLDMAP_IMAGE_INITIAL_WIDTH;
    currentMapImageHeight = currentMapImageWidth * MAP_CANVAS_WIDTH / MAP_CANVAS_HEIGHT;
    zoom = MAP_WIDTH / currentMapImageWidth;
}

function changeZoom(event, isZoomIn) {
    var oldMapImageWidth = currentMapImageWidth;
    if (isZoomIn) {
        currentMapImageWidth -= zoomStep;
    } else {
        currentMapImageWidth += zoomStep;
    }

    // Recalculate zoom
    var oldZoom = zoom;
    zoom = MAP_WIDTH / currentMapImageWidth;
    if (zoom < MIN_ZOOM_VALUE) {
        currentMapImageWidth = oldMapImageWidth;
        zoom = oldZoom;
        return;
    }

    console.log("zoom: " + zoom + " / map width: " + currentMapImageWidth);

    // Change image map
    $(".worldmap").css('background-size', currentMapImageWidth + "px");

    // Move every map location and change its size.
    changeZoom_updateMapLocation();
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
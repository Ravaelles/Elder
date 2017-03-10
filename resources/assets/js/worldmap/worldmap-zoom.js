
// Zoom animation
var _WORLDMAP_ZOOM_INTERVAL = 15; // Miliseconds of interval between zoom animations
var _WORLDMAP_ZOOM_ANIMATIONS = 25; // Number of zoom animations
//var _WORLDMAP_ZOOM_SPEED_FACTOR = 3; //
var _worldmapZoomsToProceedCounter = 0; // How many zoom animation are left to proceed
//var _worldmapZoomCurrentSpeed = 0; //

// Zoom
var _MIN_ZOOM_VALUE = 0.58; // Do not lower - below this value some weird floating things happen
var _zoomStep = 50; // Background image width quantum pixel difference
var _zoom; // Current zoom - actually lower value is bigger zoom
var _zoomMessageWasShown = false;

// Revert zoom
var _oldMapImageWidth = null;
var _oldZoom = null;
var _oldWorldmapViewRectangle = {'x': 0, 'y': 0, 'width': 0, 'height': 0};

// =========================================================================

function initializeWorldmapZoom() {
    _recalculateZoom();
}

// === Public ======================================================================

function getWorldmapZoom() {
    return _zoom;
}

function changeZoom(event, isZoomIn) {
    _zoomMessageWasShown = false;

    _worldmapZoomsToProceedCounter = _WORLDMAP_ZOOM_ANIMATIONS;
    _delayChangeZoom(event, isZoomIn);
}

// === Zoom related ==============================================================

function _delayChangeZoom(event, isZoomIn) {
    setTimeout(function () {
        _processZoom(event, isZoomIn);
    }, _WORLDMAP_ZOOM_INTERVAL);
}

function _processZoom(event, isZoomIn) {

    // Validate that we need to zoom smoothly
    if (_worldmapZoomsToProceedCounter > 0) {
        _worldmapZoomsToProceedCounter--;
//        _worldmapZoomCurrentSpeed += Math.sqrt(_WORLDMAP_ZOOM_SPEED_FACTOR);
    } else {
//        _worldmapZoomCurrentSpeed = 0;
        return;
    }

    // =========================================================================
    // Remember initial view variables
    _oldMapImageWidth = _currentWorldmapImageWidth;
    _oldZoom = _zoom;
    _oldWorldmapViewRectangle = getWorldmapViewRectangle();

    // =========================================================================
    // Revert if zoom is not allowed (too far, too close)
    if (!_changeZoomAndCheckIfAllowed(event, isZoomIn)) {
        return _revertZoom(); // Returns nothing, just exits
    }

    // Zoom is okay
    else {
        updateViewRectangle();
//        var diffInView = updateViewRectangle();
//        console.log(diffInView);
    }

    // =========================================================================
    // =========================================================================
    // Update view rectangle, make sure in bound, apply small fixes to center etc
    _afterZoomMakeSureWeReInbound(event, isZoomIn);

    // =========================================================================
    // Move every map location and change its size.
    _afterZoomUpdateMapLocations();

    // =========================================================================
    // Fire mouse move event because the map has moved
    mapMouseMove(event);

    // =========================================================================
    // Smoothly delay next zoom animation if needed
    _delayChangeZoom(event, isZoomIn);
}

function _afterZoomMakeSureWeReInbound(event, isZoomIn) {
    var topLeftCoords = getCurrentTopLeftPointMapCoordinates();
    var dX = topLeftCoords['mapX'] - _oldWorldmapViewRectangle['x'];
    var dY = topLeftCoords['mapY'] - _oldWorldmapViewRectangle['y'];

    // Enforce that the view rectangle is in bounds; moving the worldmap by [0,0] does that
    var counterModifier = 2;
    if (isZoomIn) {
        moveWorldmapBackgroundImage(_zoomStep / counterModifier, _zoomStep / counterModifier);
    } else {
        moveWorldmapBackgroundImage(_zoomStep / -counterModifier, _zoomStep / -counterModifier);
    }
}

function _afterZoomUpdateMapLocations() {

    // Recalculate margin-top for location label
    recalculateWorldmapLocationVariables();

    // Change location and size of every worldmap location
    var worldmapLocations = $(".worldmap-location");
    $.each(worldmapLocations, function (index, object) {
        var worldmapObject = $("#" + object['id']);
        var variableName = worldmapObject.attr('variableName');
        var variableIndex = worldmapObject.attr('variableIndex');
        var mapLocationObject = window[variableName][variableIndex];

        var canvasCoordinates = getCanvasCoordinatesFromMapCoordinates(
                mapLocationObject['location']['x'], mapLocationObject['location']['y']
                );

        // Change size, X and Y
        worldmapObject.css({
            'width': WORLDMAP_LOCATION_SIZE + 'px',
            'height': WORLDMAP_LOCATION_SIZE + 'px',
            'left': canvasCoordinates['canvasX'] - WORLDMAP_LOCATION_SIZE / 2,
            'top': canvasCoordinates['canvasY'] - WORLDMAP_LOCATION_SIZE / 2,
            'border-width': WORLDMAP_LOCATION_BORDER_WIDTH + 'px'
        });
    });

    // Change css for all worldmap location labels
    $(".worldmap-location label").css({
        'margin-top': WORLDMAP_LOCATION_LABEL_MARGIN_TOP + 'px',
        'margin-left': WORLDMAP_LOCATION_LABEL_MARGIN_LEFT + 'px',
    });
}

function _recalculateZoom() {
    _zoom = WORLDMAP_WIDTH / _currentWorldmapImageWidth;
}

function _changeZoomAndCheckIfAllowed(event, isZoomIn) {
    var quantumOfChange = _zoomStep; //  * _worldmapZoomCurrentSpeed
    if (isZoomIn) {
        _currentWorldmapImageWidth -= _zoomStep;
    } else {
        _currentWorldmapImageWidth += _zoomStep;
    }

    // Recalculate zoom
    _recalculateZoom();

    // === Revert zoom if too close/far =========================================

    var isZoomTooClose = _zoom < _MIN_ZOOM_VALUE; // Zoom is TOO BIG, background would be too pixel
    var isZoomTooFar = _currentWorldmapImageWidth < WORLDMAP_CANVAS_WIDTH;
    if (isZoomTooClose) {
        worldmapMessage("Maximum zoom reached!", "#f35");
        _zoomMessageWasShown = true;
        return false;
    } else if (isZoomTooFar) {
        worldmapMessage("Maximum zoom out reached!", "#2f3");
        _zoomMessageWasShown = true;
        return false;
    } else {
        return true;
    }
}

function _revertZoom() {
    _currentWorldmapImageWidth = _oldMapImageWidth;
    _zoom = _oldZoom;
    _worldmapViewRectangle = _oldWorldmapViewRectangle;
}

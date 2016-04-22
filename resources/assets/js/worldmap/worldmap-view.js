
// Initial view settings
var _WORLDMAP_IMAGE_INITIAL_WIDTH = 3500;
var _WORLDMAP_IMAGE_INITIAL_X = 1000;
var _WORLDMAP_IMAGE_INITIAL_Y = 1000;

// View rectangle
var _worldmapViewRectangle = null;
var _currentWorldmapImageWidth = null;
var _currentWorldmapImageHeight = null;

// === Set up view & zoom ===================================================

function initializeWorldmapView() {

    // Define rectangle view width and height
    _currentWorldmapImageWidth = _WORLDMAP_IMAGE_INITIAL_WIDTH;
    _currentWorldmapImageHeight = _currentWorldmapImageWidth * WORLDMAP_CANVAS_WIDTH / WORLDMAP_CANVAS_HEIGHT;

    // Definte rectangle view
    _worldmapViewRectangle = {
        'x': _WORLDMAP_IMAGE_INITIAL_X,
        'y': _WORLDMAP_IMAGE_INITIAL_Y,
        'width': WORLDMAP_CANVAS_WIDTH,
        'height': WORLDMAP_CANVAS_HEIGHT
    };

    // Init zoom
    initializeWorldmapZoom();

    // Assign proper values for background image
    updateViewRectangle(_worldmapViewRectangle['x'], _worldmapViewRectangle['y']);
}

// === Public ======================================================================

function getWorldmapViewRectangle() {
    return cloneObject(_worldmapViewRectangle);
}

function getWorldmapViewRectangleWidth() {
    return _worldmapViewRectangle['width'];
}

function getWorldmapViewRectangleHeight() {
    return _worldmapViewRectangle['height'];
}

function getMapOffsetPixelsX() {
    return _worldmapViewRectangle['x'];
}

function getMapOffsetPixelsY() {
    return _worldmapViewRectangle['y'];
}

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

        _worldmapViewRectangle['x'] = newX;
        _worldmapViewRectangle['y'] = newY;

        // Update background image position
        getWorldmap().css({
            'background-position': -newX + "px " + -newY + "px"
        });
    }

    // Update width and height of view rectangle
    _worldmapViewRectangle['width'] = WORLDMAP_CANVAS_WIDTH / getWorldmapZoom();
    _worldmapViewRectangle['height'] = WORLDMAP_CANVAS_HEIGHT / getWorldmapZoom();

    // Update background image size
    getWorldmap().css({
        'background-size': _currentWorldmapImageWidth + "px auto"
    });

    // =========================================================================
    // Return difference in view rectangle field values

//    console.log('');
//    console.log("NEW:");
//    console.log(_worldmapViewRectangle);
//    console.log("OLD");
//    console.log(_oldWorldmapViewRectangle);

//    return {
//        'dX': (_worldmapViewRectangle['x'] - _oldWorldmapViewRectangle['x']),
//        'dY': (_worldmapViewRectangle['y'] - _oldWorldmapViewRectangle['y']),
//        'dWidth': (_worldmapViewRectangle['width'] - _oldWorldmapViewRectangle['width']),
//        'dHeight': (_worldmapViewRectangle['height'] - _oldWorldmapViewRectangle['height'])
//    };
}
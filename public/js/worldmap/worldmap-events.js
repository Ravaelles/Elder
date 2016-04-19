var mouseIsClicked = false;
var mousePreviousPosition = null;
var mouseHasMoved = false;

// === Map events ======================================================================

function initializeWorldmapEvents() {
    $(".worldmap")
            .mousedown(function (event) {
                mapMouseDown(event);
            })
            .mousemove(function (event) {
                mapMouseMove(event);
            })
            .mouseup(function (event) {
                mapMouseUp(event);
            })
            .mousewheel(function (event) {
                mapScroll(event);
            })
//            .click(function (event) {
//                mapClick(event);
//            })
            .mouseleave(function (event) {
                mapMouseLeave(event);
            });

    $(".worldmap-location")
            .mousedown(function (event) {
                mapMouseDown(event);
            })
            .mousemove(function (event) {
                mapMouseMove(event);
            })
            .mouseup(function (event) {
                mapMouseUp(event);
            });
}

function mapMouseDown(event) {
    worldmap = $(".worldmap");
    mousePreviousPosition = event;
    mouseIsClicked = true;
    mouseHasMoved = false;
}

function mapMouseUp(event) {
    if (!mouseHasMoved) {
        mapClick(event);
    }

    mouseIsClicked = false;
    mousePreviousPosition = null;
}

function mapMouseMove(event) {
    mouseHasMoved = true;

    if (mouseIsClicked && mousePreviousPosition != null) {
        translationVector = moveMapImage(event);
        moveMapObjects(translationVector);
    }

    mousePreviousPosition = event;
}

function mapScroll(event) {
    var scrollType = event.deltaY; // 1 for wheel up, -1 for wheel down

    // Wheel up
    if (scrollType >= 1) {
        changeZoom(event, false);
    }

    // Wheel down
    else if (scrollType <= -1) {
        changeZoom(event, true);
    }
}

function mapMouseLeave(event) {
    mapMouseUp(event);
}

function mapClick(event) {
    var coordinates = getCoordinatesFromMapClick(event);
    console.log(coordinates);
}

// =========================================================================

function getCoordinatesFromMapClick(event) {

    // Define click on map canvas manually, because if clicked on a child, it changes .offsetX value.
    var canvasClickX = event.pageX - $(".sidebar").width();
    var canvasClickY = event.pageY - $(".main-header").height();

    // X-related
    var backgroundOffsetX = -1 * worldmap.css('background-position-x').slice(0, -2);
    var coordinatesOffsetX = backgroundOffsetX * zoom;
    var mapScreenWidth = MAP_CANVAS_WIDTH * zoom;
    var mapScreenWidthPercent = canvasClickX / MAP_CANVAS_WIDTH;

    // Y-related
    var backgroundOffsetY = -1 * worldmap.css('background-position-y').slice(0, -2);
    var coordinatesOffsetY = backgroundOffsetY * zoom;
    var mapScreenHeight = MAP_CANVAS_HEIGHT * zoom;
    var mapScreenHeightPercent = canvasClickY / MAP_CANVAS_HEIGHT;

    // Return object
    var x = parseInt(coordinatesOffsetX + mapScreenWidthPercent * mapScreenWidth);
    var y = parseInt(coordinatesOffsetY + mapScreenHeightPercent * mapScreenHeight);
    return {'x': x, 'y': y};
}
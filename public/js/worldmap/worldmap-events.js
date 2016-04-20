var mouseIsClicked = false;
var mousePreviousPosition = null;
var mouseHasMoved = false;

// === Map events ======================================================================

function initializeWorldmapEvents() {
    $(".worldmap-location")
            .mousedown(function (event) {
                mapMouseDown(event);
                event.stopPropagation();
            })
            .mouseup(function (event) {
                mapMouseUp(event);
                event.stopPropagation();
            })
            .mousemove(function (event) {
                mapMouseMove(event);
                event.stopPropagation();
            });

    $(".worldmap")
            .mousedown(function (event) {
                mapMouseDown(event);
            })
            .mouseup(function (event) {
                mapMouseUp(event);
            })
            .mousemove(function (event) {
                mapMouseMove(event);
            })
            .mousewheel(function (event) {
                mapScroll(event);
            })
            .mouseleave(function (event) {
                mapMouseLeave(event);
            })
            .contextmenu(function (event) {
//                event.preventDefault(); // Stop the context menu
            });
}

function mapMouseDown(event) {
    worldmap = $(".worldmap");

    // Right click
    if (event.button === 2) {
        console.log("Right click");
//        event.preventDefault();
//        event.stopPropagation()();
//        return true;
    }

    // Left or middle click
    else {
    }

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
    if (mouseIsClicked) {
        mouseHasMoved = true;
    }

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
    if (mouseIsClicked) {
        mapMouseUp(event);
        mouseIsClicked = false;
    }
}

function mapClick(event) {
    var coordinates = getMapCoordinatesFromScreenClick(event);
    gameLog('<span>[' + coordinates['mapX'] + ',' + coordinates['mapY'] + ']</span> is unknown wasteland, '
            + 'not very hospitable place.');
}

// =========================================================================

function getMapCoordinatesFromScreenClick(event) {

    // Define click on map canvas manually, because if clicked on a child, it changes .offsetX value.
    var canvasClickX = event.pageX - WORLDMAP_CANVAS_MARGIN_LEFT;
    var canvasClickY = event.pageY - WORLDMAP_CANVAS_MARGIN_TOP;

    // X-related
    var backgroundOffsetX = -1 * worldmap.css('background-position-x').slice(0, -2);
    var coordinatesOffsetX = backgroundOffsetX * zoom;
    var mapScreenWidth = WORLDMAP_CANVAS_WIDTH * zoom;
    var mapScreenWidthPercent = canvasClickX / WORLDMAP_CANVAS_WIDTH;

    // Y-related
    var backgroundOffsetY = -1 * worldmap.css('background-position-y').slice(0, -2);
    var coordinatesOffsetY = backgroundOffsetY * zoom;
    var mapScreenHeight = WORLDMAP_CANVAS_HEIGHT * zoom;
    var mapScreenHeightPercent = canvasClickY / WORLDMAP_CANVAS_HEIGHT;

    // Return object
    var mapX = parseInt(coordinatesOffsetX + mapScreenWidthPercent * mapScreenWidth);
    var mapY = parseInt(coordinatesOffsetY + mapScreenHeightPercent * mapScreenHeight);
    return {'mapX': mapX, 'mapY': mapY};
}

function getCanvasCoordinatesFromMapCoordinates(mapX, mapY) {
    return {'canvasX': mapX / zoom - getMapOffsetPixelsX(), 'canvasY': mapY / zoom - getMapOffsetPixelsY()};
}
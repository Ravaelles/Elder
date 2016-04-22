var FORBID_RIGHT_CLICK = false;

// =========================================================================

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
                if (FORBID_RIGHT_CLICK) {
                    event.preventDefault(); // Stop the context menu
                }
            });
}

// =========================================================================

function mapMouseDown(event) {
    worldmap = $(".worldmap");

    // Right click
    if (event.button === 2) {
//        console.log("Right click");
//        event.preventDefault();
//        event.stopPropagation()();
//        return true;
    }

    // Left or middle click
    else {
//        worldmapMessage("Maximum zoom reached!", "#f35");
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
    mouseHasMoved = false;
}

function mapMouseMove(event) {
    if (mouseIsClicked) {
        mouseHasMoved = true;
    }

    if (mouseIsClicked && mousePreviousPosition != null) {
        translationVector = moveWorldmapBackgroundImage(event);
        moveWorldmapObjects(translationVector);
    }

    mousePreviousPosition = event;

    // =========================================================================
    // Show coords
    worldmapMessageForever(
            "Mouse points to " + coordinatesToString(getMapCoordinatesFromScreenClick(event)), 'mouse-cords'
            );
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

    // Force mouse move event as scroll will change cursor relative position on the map
    mapMouseMove(event);
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
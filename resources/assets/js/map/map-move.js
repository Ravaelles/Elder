var mousePreviousPosition = null;
var mouseIsClicked = false;
var mouseHasMoved = false;

// =========================================================================

function initializeMapMove() {
    $("#map-canvas")
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
//    worldmapMessageForever(
//            "Mouse points to " + coordinatesToString(getMapCoordinatesFromScreenClick(event)), 'mouse-cords'
//            );
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
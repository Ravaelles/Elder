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
    return {
        'canvasX': WORLDMAP_CANVAS_MARGIN_LEFT + mapX / zoom - getMapOffsetPixelsX() + 2,
        'canvasY': WORLDMAP_CANVAS_MARGIN_TOP + mapY / zoom - getMapOffsetPixelsY() + 1
    };
}

// =========================================================================

function coordinatesToString(coordinates) {
    if ('canvasX' in coordinates) {
        return "[" + coordinates['canvasX'] + "," + coordinates['canvasY'] + "]";
    } else {
        return "[" + coordinates['mapX'] + "," + coordinates['mapY'] + "]";
    }
}
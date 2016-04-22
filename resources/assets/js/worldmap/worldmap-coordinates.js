function getMapCoordinatesFromScreenClick(event) {

    // Define click on map canvas manually, because if clicked on a child, it changes .offsetX value.
    var canvasClickX = event.pageX - WORLDMAP_CANVAS_MARGIN_LEFT;
    var canvasClickY = event.pageY - WORLDMAP_CANVAS_MARGIN_TOP;

    // X-related
    var coordinatesOffsetX = getMapOffsetPixelsX() * getWorldmapZoom();
    var mapScreenWidth = WORLDMAP_CANVAS_WIDTH * getWorldmapZoom();
    var mapScreenWidthPercent = canvasClickX / WORLDMAP_CANVAS_WIDTH;

    // Y-related
    var coordinatesOffsetY = getMapOffsetPixelsY() * getWorldmapZoom();
    var mapScreenHeight = WORLDMAP_CANVAS_HEIGHT * getWorldmapZoom();
    var mapScreenHeightPercent = canvasClickY / WORLDMAP_CANVAS_HEIGHT;

    // Return object
    var mapX = parseInt(coordinatesOffsetX + mapScreenWidthPercent * mapScreenWidth);
    var mapY = parseInt(coordinatesOffsetY + mapScreenHeightPercent * mapScreenHeight);
    return {'mapX': mapX, 'mapY': mapY};
}

function getCanvasCoordinatesFromMapCoordinates(mapX, mapY) {
    return {
        'canvasX': WORLDMAP_CANVAS_MARGIN_LEFT + mapX / getWorldmapZoom() - getMapOffsetPixelsX() + 2,
        'canvasY': WORLDMAP_CANVAS_MARGIN_TOP + mapY / getWorldmapZoom() - getMapOffsetPixelsY() + 1
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
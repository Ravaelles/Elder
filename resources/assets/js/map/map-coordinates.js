function getCanvasCoordinatesForTileX(tileX) {
    return MAP_CANVAS_OFFSET_LEFT + (tileX * TILE_SIZE);
}

function getCanvasCoordinatesForTileY(tileY) {
    return MAP_CANVAS_OFFSET_TOP + (tileY * TILE_SIZE);
}
function createElement_mapObject(mapObject) {
    var type = mapObject['type'];
    var canvasX = getCanvasCoordinatesForTileX(mapObject['x'] + mapObject['dx']);
    var canvasY = getCanvasCoordinatesForTileY(mapObject['y'] + mapObject['dy']);

    var html = '<img class="map-object map-object-' + type + '" style="top: '
            + canvasY + 'px; left: ' + canvasX + 'px" src="' + mapObject['image'] + '">'

    return html;
}


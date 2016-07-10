window.initQueue.push(function () {
    var mapWidth = world['map-width'];
    var mapHeight = world['map-height'];
    var tiles = world['tiles'];
    var mapObjects = world['map-objects'];
    var html = "";

    // === Tiles ======================================================================

    for (row = 0; row < mapHeight; row++) {
        for (col = 0; col < mapWidth; col++) {
            html += createElement_tile(tiles[row][col], col, row);
        }
    }

    // === MapObjects ======================================================================

    for (var i in mapObjects) {
        var mapObject = mapObjects[i];
        html += createElement_mapObject(mapObject);
    }

    // =========================================================================
    // Add html to the map

    addHtmlToMapCanvas(html);
});

// =========================================================================
// =========================================================================
// =========================================================================

function createElement_tile(tile, x, y) {
    var html = '<img class="map-tile" data-x="' + x + '" data-y="' + y + '" style="top: '
            + getCanvasCoordinatesForTileY(y) + 'px; left: '
            + getCanvasCoordinatesForTileX(x) + 'px" src="' + tile['image'] + '">';
    //        html = '<img class="map-object" style="top: ' + (y * TILE_SIZE / 2) + 'px; left: '
    //                + (x * TILE_SIZE + (y % 2 === 0 ? 0 : TILE_SIZE / 2)) + 'px" src="' + tile['image'] + '">';
    //        $("#map-canvas").append(html);

    return html;
}

function createElement_mapObject(mapObject) {
    var x = mapObject['x'] + mapObject['dx'];
    var y = mapObject['y'] + mapObject['dy'];
    var html = '<img class="map-object" style="top: ' + (y * TILE_SIZE) + 'px; left: '
            + (x * TILE_SIZE) + 'px" src="' + mapObject['image'] + '">'

    return html;
}

// =========================================================================

function addHtmlToMapCanvas(html) {
    var div = document.getElementById('map-canvas');
    div.innerHTML = div.innerHTML + html;
}
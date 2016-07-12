window.initQueue.push(function () {
    var mapWidth = world['map-width'];
    var mapHeight = world['map-height'];
    var tiles = world['tiles'];
    var rawMapObjects = world['map-objects'];
    var html = "";

    // === Tiles ======================================================================

    for (row = 0; row < mapHeight; row++) {
        for (col = 0; col < mapWidth; col++) {
            html += createElement_tile(tiles[row][col], col, row);
        }
    }

    // === MapObjects ======================================================================

    for (var i in rawMapObjects) {
        var rawMapObject = rawMapObjects[i];
        var mapObject = new MapObject(rawMapObject);
        html += mapObject.createElement();
    }

    // =========================================================================
    // Add html to the map

    addHtmlToMapCanvas(html);
});

// =========================================================================
// =========================================================================
// =========================================================================

function addHtmlToMapCanvas(html) {
    var div = document.getElementById('map-canvas');
    div.innerHTML = div.innerHTML + html;
}
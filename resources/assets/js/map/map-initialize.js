window.initQueue.push(function () {
    var mapWidth = world['map-width'];
    var mapHeight = world['map-height'];
    var tiles = world['tiles'];

    // =========================================================================

    for (row = 0; row < mapHeight; row++) {
        for (col = 0; col < mapWidth; col++) {
            createElementTile(tiles[row][col], col, row);
        }
    }
});

// =========================================================================
// =========================================================================
// =========================================================================

function createElementTile(tile, x, y) {
    html = '<img class="map-object" style="top: ' + (y * TILE_SIZE) + 'px; left: '
            + (x * TILE_SIZE) + 'px" src="' + tile['image'] + '">';
    //        html = '<img class="map-object" style="top: ' + (y * TILE_SIZE / 2) + 'px; left: '
    //                + (x * TILE_SIZE + (y % 2 === 0 ? 0 : TILE_SIZE / 2)) + 'px" src="' + tile['image'] + '">';
    //        $("#map-canvas").append(html);

    var div = document.getElementById('map-canvas');
    div.innerHTML = div.innerHTML + html;
}
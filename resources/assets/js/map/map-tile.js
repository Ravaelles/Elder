function createElement_tile(tile, x, y) {
    var canvasX = getCanvasCoordinatesForTileX(x);
    var canvasY = getCanvasCoordinatesForTileY(y);

    var html = '<img class="map-tile" data-x="' + x + '" data-y="' + y + '" style="top: '
            + canvasY + 'px; left: ' + canvasX + 'px" src="' + tile['image'] + '">';

    return html;
}


function createElement_tile(tile, x, y) {
    var canvasX = getCanvasXForTile(x);
    var canvasY = getCanvasYForTile(y);

    var style = 'top: ' + canvasY + 'px; left: ' + canvasX + 'px;';

    var html = '<img class="map-tile" data-x="' + x + '" data-y="' + y + '" style="' + style
            + '" src="' + tile['image'] + '"' + ' width=' + getTileSize() + ' height=' + getTileSize() + '>';

    return html;
}


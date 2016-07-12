// =========================================================================
// Coordinates for tile

function getCanvasXForTile(tileX) {
    return (tileX * getTileSize());
}

function getCanvasYForTile(tileY) {
    return (tileY * getTileSize());
}

// =========================================================================
// Coordinates for map objects

//function getCanvasXForMapObject(mapObject) {
//    return ((mapObject['TX'] + 0.5 + mapObject['dTX']) * getTileSize()) - getTileSize() / 2;
////    return ((mapObject['TX'] + 0.5 + mapObject['dTX']) * getTileSize()) - mapObject['width'] / 2;
//}
//
//function getCanvasYForMapObject(mapObject) {
//    return ((mapObject['TY'] + 0.5 + mapObject['dTY']) * getTileSize()) - mapObject['height'] / 2;
////    return ((mapObject['TY'] + 0.5 + mapObject['dTY']) * getTileSize());
//}
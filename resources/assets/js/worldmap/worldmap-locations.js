var WORLDMAP_LOCATION_SIZE_MODIFIER = 35;
var WORLDMAP_LOCATION_SIZE = null;
var WORLDMAP_LOCATION_LABEL_MARGIN_TOP = null;

// =========================================================================

function initializeWorldmapLocations() {
    var worldmap = $(".worldmap");
    recalculateWorldmapLocationVariables();

    worldmapLocations.forEach(function (location, index) {
        worldmap.append(createHtmlFromLocationJson(location, index));
    });
}

function createHtmlFromLocationJson(location, index) {
    var id = location['_id'];
    var text = location['location']['x'] + "," + location['location']['y'];
//    var text = location['name'];
    var size = WORLDMAP_LOCATION_SIZE;
    var canvasCoordinates = getCanvasCoordinatesFromMapCoordinates(
//            location['location']['x'] - size / 2, location['location']['y'] - size / 2
            location['location']['x'], location['location']['y']
            );
//    if (index == 0) {
//        console.log("ZOOM:");
//        console.log(canvasCoordinates);
//    }
    var style = 'top:' + (canvasCoordinates['canvasY'] - size / 2) + 'px;left:'
            + (canvasCoordinates['canvasX'] - size / 2) + 'px;'
            + 'width:' + size + 'px;height:' + size + 'px;';
    return '<div class="worldmap-location" id="worldmap-location-' + id + '" '
            + 'variableName="worldmapLocations" variableIndex="' + index + '" style="' + style + '">'
            + '<label style="margin-top:' + WORLDMAP_LOCATION_LABEL_MARGIN_TOP + 'px">' + text + '</label>'
            + '</div>';
}

function recalculateWorldmapLocationVariables() {
    WORLDMAP_LOCATION_SIZE = WORLDMAP_LOCATION_SIZE_MODIFIER / zoom;
    WORLDMAP_LOCATION_LABEL_MARGIN_TOP = WORLDMAP_LOCATION_SIZE_MODIFIER / zoom * 0.99;
//    console.log("LOCATION_SIZE = " + LOCATION_SIZE);
//    console.log("LOCATION_LABEL_MARGIN_TOP = " + LOCATION_LABEL_MARGIN_TOP);
}
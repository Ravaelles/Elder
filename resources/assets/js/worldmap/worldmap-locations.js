var WORLDMAP_LOCATION_SIZE = null;
var WORLDMAP_LOCATION_LABEL_MARGIN_LEFT = null;
var WORLDMAP_LOCATION_LABEL_MARGIN_TOP = null;

var _WORLDMAP_LOCATION_SIZE_MODIFIER = 35;
var _WORLDMAP_LOCATION_LABEL_WIDTH = 100;

// =========================================================================

function initializeWorldmapLocations() {
    recalculateWorldmapLocationVariables();

    worldmapLocations.forEach(function (location, index) {
        getWorldmap().append(createHtmlFromLocationJson(location, index));
    });
}

// =========================================================================

function createHtmlFromLocationJson(location, index) {
    var id = location['_id'];
//    var text = location['location']['x'] + "," + location['location']['y'];
    var text = location['name'];
    var labelWidth = WORLDMAP_LOCATION_SIZE;

    var canvasCoordinates = getCanvasCoordinatesFromMapCoordinates(
//            location['location']['x'] - size / 2, location['location']['y'] - size / 2
            location['location']['x'], location['location']['y']
            );

    var locationStyle = 'top:' + (canvasCoordinates['canvasY'] - WORLDMAP_LOCATION_SIZE / 2) + 'px;left:'
            + (canvasCoordinates['canvasX'] - WORLDMAP_LOCATION_SIZE / 2) + 'px;'
            + 'width:' + WORLDMAP_LOCATION_SIZE + 'px;height:' + WORLDMAP_LOCATION_SIZE + 'px';

    var labelStyle = 'margin-top:' + WORLDMAP_LOCATION_LABEL_MARGIN_TOP
            + 'px;margin-left:' + WORLDMAP_LOCATION_LABEL_MARGIN_LEFT + 'px';

    return '<div class="worldmap-location" id="worldmap-location-' + id + '" '
            + 'variableName="worldmapLocations" variableIndex="' + index + '" style="' + locationStyle + '">'
            + '<label style="' + labelStyle + '">' + text + '</label>'
            + '</div>';
}

function recalculateWorldmapLocationVariables() {
    WORLDMAP_LOCATION_SIZE = _WORLDMAP_LOCATION_SIZE_MODIFIER / getWorldmapZoom();
    WORLDMAP_LOCATION_BORDER_WIDTH = 1.5;
    WORLDMAP_LOCATION_LABEL_MARGIN_TOP = _WORLDMAP_LOCATION_SIZE_MODIFIER / getWorldmapZoom() * 1.02;
    WORLDMAP_LOCATION_LABEL_MARGIN_LEFT = -_WORLDMAP_LOCATION_LABEL_WIDTH / 2 + WORLDMAP_LOCATION_SIZE / 2
            - WORLDMAP_LOCATION_BORDER_WIDTH + 1;
}
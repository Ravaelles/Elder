var defaultLocationSize = 15;

function initializeWorldmapLocations() {
    var worldmap = $(".worldmap");
    worldmapLocations.forEach(function (location) {
        worldmap.append(createHtmlFromLocationJson(location));
    });
//    worldmap.append(createHtmlFromLocationJson(location));

//    console.log($("#worldmap-location-stylesheet").get(0).children());
}

function createHtmlFromLocationJson(location) {
    var id = location['_id'];
    var text = location['name'] + ' ' + JSON.stringify(location['location']);
    var x = location['location']['x'] / zoom;
    var y = location['location']['y'] / zoom;
    var size = defaultLocationSize * zoom;
    var style = 'top:' + y + 'px;left:' + x + 'px;' + 'width:' + size + 'px;height:' + size + 'px;';
    return '<div class="worldmap-location" id="worldmap-location-' + id + '" style="' + style + '">'
            + '<label>' + text + '</label>'
            + '</div>';
}
function initializeWorldmapLocations() {
    var worldmap = $(".worldmap");
    worldmapLocations.forEach(function (location) {
        worldmap.append(createHtmlFromLocationJson(location));
    });
//    worldmap.append(createHtmlFromLocationJson(location));

    console.log($("#worldmap-location-stylesheet").get(0).children());
}

function createHtmlFromLocationJson(location) {
    var id = location['_id'];
    var text = location['name'] + ' ' + JSON.stringify(location['location']);
    var style = 'top: ' + location['location']['y'] + 'px; left: ' + location['location']['x'] + 'px';
    return '<div class="worldmap-location" id="worldmap-location-' + id + '" style="' + style + '">'
            + '<label>' + text + '</label>'
            + '</div>';
}
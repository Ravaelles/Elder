var zoom = 1;
var zoomStep = 200;

// === Zoom ======================================================================

function changeZoom(event, isZoomIn) {
    var oldMapImageWidth = currentMapImageWidth;
    if (isZoomIn) {
        currentMapImageWidth -= zoomStep;
    } else {
        currentMapImageWidth += zoomStep;
    }

    // Recalculate zoom
    zoom = currentMapImageWidth / oldMapImageWidth;
//    console.log("zoom: " + zoom + " / map width: " + currentMapImageWidth);

    // Change image map
    $(".worldmap").css('background-size', currentMapImageWidth + "px");

    // Change location and size of every worldmap location
    var mapLocations = $(".worldmap-location");
    $.each(mapLocations, function (index, object) {
        var mapObject = $("#" + object['id']);

        // Change X,Y
        var oldX = parseFloat(mapObject.css('left'));
        var oldY = parseFloat(mapObject.css('top'));
        mapObject.css('left', oldX * zoom);
        mapObject.css('top', oldY * zoom);

        // Change size
        var currentSize = mapObject.css('width').slice(0, -2);
        mapObject.css('width', currentSize * zoom + "px");
        mapObject.css('height', currentSize * zoom + "px");
    });
}

//function currentMapImageHeight() {
//
//}

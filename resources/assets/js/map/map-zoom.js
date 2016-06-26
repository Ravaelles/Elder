window.initQueue.push(function () {
    $("#map-canvas").mousewheel(function (event) {
        _mapScroll(event);
    });
});

// =========================================================================

function changeZoom(event, isZoomIn) {

}

// =========================================================================

function _mapScroll(event) {
    var scrollType = event.deltaY; // 1 for wheel up, -1 for wheel down

    // Wheel up
    if (scrollType >= 1) {
        changeZoom(event, false);
    }

    // Wheel down
    else if (scrollType <= -1) {
        changeZoom(event, true);
    }

    // Force mouse move event as scroll will change cursor relative position on the map
//    mapMouseMove(event);
}
var MAP_WIDTH_PIXELS = 3500;
var MAP_HEIGHT_PIXELS = 3500;
//var MOUSE_DRAG_MODIFIER = -0.07;
var MOUSE_DRAG_MODIFIER = 0.5;

var MAP_CANVAS_WIDTH = null;
var MAP_CANVAS_HEIGHT = null;

// =========================================================================

var mouseIsDragging = false;
var mousePreviousPosition = null;
var worldmap = null;

// === Move map / objects ==============================================================

function moveMapImage(event) {
    var dx = event.pageX - mousePreviousPosition.pageX;
    var dy = event.pageY - mousePreviousPosition.pageY;

    // Get current image position
    var imagePosX = worldmap.css('background-position-x');
    var imagePosY = worldmap.css('background-position-y');
    imagePosX = parseFloat(imagePosX.substr(0, imagePosX.length - 2));
    imagePosY = parseFloat(imagePosY.substr(0, imagePosY.length - 2));
//    console.log(imagePosX + " / " + imagePosY);

    // Modify variable image position
    deltaImagePosX = dx * MOUSE_DRAG_MODIFIER * zoom;
    deltaImagePosY = dy * MOUSE_DRAG_MODIFIER * zoom;
    imagePosX += deltaImagePosX;
    imagePosY += deltaImagePosY;
    imagePosXWithScreenWidth = imagePosX - MAP_CANVAS_WIDTH;
    imagePosYWithScreenHeight = imagePosY - MAP_CANVAS_HEIGHT;
//    console.log(imagePosX + " / " + MAP_CANVAS_WIDTH + " / " + imagePosXWithScreenWidth + " // " + -MAP_WIDTH_PIXELS / zoom);
//    console.log(imagePosY + " / " + MAP_CANVAS_HEIGHT + " / " + imagePosYWithScreenHeight + " // " + -MAP_CANVAS_HEIGHT / zoom);

    // Force image to be horizontally in bounds
    if (imagePosX > 0) {
        var oldImagePosX = imagePosX;
        imagePosX = 0;
        deltaImagePosX -= (oldImagePosX - imagePosX);
    } else if (imagePosXWithScreenWidth <= -MAP_WIDTH_PIXELS / zoom) {
        var oldImagePosX = imagePosX;
        imagePosX = -MAP_WIDTH_PIXELS / zoom + MAP_CANVAS_WIDTH;
        deltaImagePosX -= (oldImagePosX - imagePosX);
    }

    // Force image to be vertically in bounds
    if (imagePosY > 0) {
        var oldImagePosY = imagePosY;
        imagePosY = 0;
        deltaImagePosY -= (oldImagePosY - imagePosY);
    } else if (imagePosYWithScreenHeight <= -MAP_HEIGHT_PIXELS / zoom) {
        var oldImagePosY = imagePosY;
        imagePosY = -MAP_HEIGHT_PIXELS / zoom + MAP_CANVAS_HEIGHT;
        deltaImagePosY -= (oldImagePosY - imagePosY);
    }

    // Change image position
    setBackgroundImagePosition(imagePosX, imagePosY);

    return {dx: deltaImagePosX, dy: deltaImagePosY};
}

function moveMapObjects(translationVector) {
    var mapLocations = $(".worldmap-location");
    $.each(mapLocations, function (index, object) {
        var mapObject = $("#" + object['id']);
        mapObject.css('top', parseFloat(mapObject.css('top')) + translationVector['dy']);
        mapObject.css('left', parseFloat(mapObject.css('left')) + translationVector['dx']);
    });
}

function setBackgroundImagePosition(imagePosX, imagePosY) {
    worldmap.css('background-position-x', imagePosX + "px");
    worldmap.css('background-position-y', imagePosY + "px");
}

// === Map events ======================================================================

function initializeMapEvents() {
    $(".worldmap")
            .mousedown(function (event) {
                mapMouseDown(event);
            })
            .mousemove(function (event) {
                mapMouseMove(event);
            })
            .mouseup(function (event) {
                mapMouseUp(event);
            })
            .mousewheel(function (event) {
                mapScroll(event);
            })
            .mouseleave(function (event) {
                mapMouseLeave(event);
            });
//    $(".worldmap").mousewheel(function (event) {
//        console.log(event);
//        mapScroll(event);
//    });

    $(".worldmap-location")
            .mousedown(function (event) {
                mapMouseDown(event);
            })
            .mousemove(function (event) {
                mapMouseMove(event);
            })
            .mouseup(function (event) {
                mapMouseUp(event);
            });
}

function mapMouseDown(event) {
    mouseIsDragging = true;
    mousePreviousPosition = event;
    worldmap = $(".worldmap");
}

function mapMouseMove(event) {
    if (mouseIsDragging && mousePreviousPosition != null) {
        translationVector = moveMapImage(event);
        moveMapObjects(translationVector);
    }
    mousePreviousPosition = event;
}

function mapMouseUp(event) {
    var wasDragging = mouseIsDragging;
    mouseIsDragging = false;
    mousePreviousPosition = null;
}

function mapScroll(event) {
    var scrollType = event.deltaY; // 1 for wheel up, -1 for wheel down

    // Wheel up
    if (scrollType >= 1) {
        changeZoom(event, false);
    }

    // Wheel down
    else if (scrollType <= -1) {
        changeZoom(event, true);
    }
}

function mapMouseLeave(event) {
    mapMouseUp(event);
}

// === Zoom ======================================================================

var zoom = 1;
var zoomStep = 200;
var currentMapImageWidth = 1200;

function changeZoom(event, isZoomIn) {
    var oldMapImageWidth = currentMapImageWidth;
    if (isZoomIn) {
        currentMapImageWidth -= zoomStep;
    } else {
        currentMapImageWidth += zoomStep;
    }

    // Recalculate zoom
    zoom = currentMapImageWidth / oldMapImageWidth;
    console.log(zoom);
    console.log(currentMapImageWidth);

    // Change image map
    $(".worldmap").css('background-size', currentMapImageWidth + "px");

    // Change location and size of every worldmap location
    var mapLocations = $(".worldmap-location");
    $.each(mapLocations, function (index, object) {
        var mapObject = $("#" + object['id']);
        var oldX = parseFloat(mapObject.css('left'));
        var oldY = parseFloat(mapObject.css('top'));
        mapObject.css('left', oldX * zoom);
        mapObject.css('top', oldY * zoom);
    });
}

// === Initialize ======================================================================

function initializeWorldmap() {
    var worldmap = $(".worldmap");
    worldmap.css('background-image', 'url("/img/map/map.jpg")');
//    worldmap.css('background-size', '500px 500px');
//    worldmap.css('background-size', MAP_WIDTH_PIXELS + 'px ' + MAP_HEIGHT_PIXELS + 'px');
    worldmap.css('background-size', currentMapImageWidth + "px");
    zoom = MAP_WIDTH_PIXELS / 1100;
    worldmap.css('background-position-x', '-100px');
    worldmap.css('background-position-y', '-100px');
}

window.initQueue.push(function () {
    setTimeout(function () {
        MAP_CANVAS_WIDTH = $(".worldmap").width();
        MAP_CANVAS_HEIGHT = $(".content-wrapper").height();

        initializeWorldmap();
        initializeMapEvents();
    }, 80);
});




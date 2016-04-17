var MAP_WIDTH_PIXELS = 3542;
var MAP_HEIGHT_PIXELS = 3592;
var MOUSE_DRAG_MODIFIER = -0.07;

// =========================================================================

var mouseIsDragging = false;
var mousePreviousPosition = null;
var worldmap = null;

// =========================================================================

function moveMap(event) {
    var dx = event.pageX - mousePreviousPosition.pageX;
    var dy = event.pageY - mousePreviousPosition.pageY;

    // Get current image position
    var imagePosX = worldmap.css('background-position-x');
    var imagePosY = worldmap.css('background-position-y');
    imagePosX = parseFloat(imagePosX.substr(0, imagePosX.length - 1));
    imagePosY = parseFloat(imagePosY.substr(0, imagePosY.length - 1));

    // Modify variable image position
    deltaImagePosX = dy * MOUSE_DRAG_MODIFIER;
    deltaImagePosY = dy * MOUSE_DRAG_MODIFIER;
    imagePosX += deltaImagePosX;
    imagePosY += deltaImagePosY;

    // Force image to be in bounds
    if (imagePosX < 0) {
        imagePosX = 0;
    }
    if (imagePosY < 0) {
        imagePosY = 0;
    }
    if (imagePosX > 100) {
        imagePosX = 100;
    }
    if (imagePosY > 100) {
        imagePosY = 100;
    }

    // Change image position
    worldmap.css('background-position-x', imagePosX + "%");
    worldmap.css('background-position-y', imagePosY + "%");

    // Calculate how many pixels the map has moved
    var pixelDX = deltaImagePosX * MAP_WIDTH_PIXELS / 100;
    var pixelDY = deltaImagePosY * MAP_HEIGHT_PIXELS / 100;

    return {dx: pixelDX, dy: pixelDY};
}

function moveMapObjects(translationVector) {
    var mapLocations = $(".worldmap-location");
    $.each(mapLocations, function (index, object) {
//        console.log(index + " / " + object);
        var mapObject = $("#" + object['id']);
        mapObject.css('top', parseInt(mapObject.css('top')) - translationVector['dy']);
        mapObject.css('left', parseInt(mapObject.css('left')) - translationVector['dx']);
    });
}

// =========================================================================

function mapMouseDown(event) {
    mouseIsDragging = true;
    mousePreviousPosition = event;
    worldmap = $(".worldmap");
}

function mapMouseMove(event) {
    if (mouseIsDragging && mousePreviousPosition != null) {
        translationVector = moveMap(event);
        moveMapObjects(translationVector);
    }
    mousePreviousPosition = event;
}

function mapMouseUp(event) {
    var wasDragging = mouseIsDragging;
    mouseIsDragging = false;
    mousePreviousPosition = null;
}

// =========================================================================

window.initQueue.push(function () {
    $(".worldmap")
            .mousedown(function (event) {
                mapMouseDown(event);
            })
            .mousemove(function (event) {
                mapMouseMove(event);
            })
            .mouseup(function (event) {
                mapMouseUp(event);
            });
});




var MOUSE_DRAG_MODIFIER = 1;

// === Move map / objects ==============================================================

function moveWorldmapBackgroundImage(eventOrX, yOrNull) {
    if (isUndefined(yOrNull)) {
        var dx = event.pageX - mousePreviousPosition.pageX;
        var dy = event.pageY - mousePreviousPosition.pageY;
    } else {
        var dx = eventOrX;
        var dy = yOrNull;
    }

    // =========================================================================
    // Get current image position
    var imagePosX = -1 * getMapOffsetPixelsX();
    var imagePosY = -1 * getMapOffsetPixelsY();

    // Modify variable image position
    deltaImagePosX = dx;
    deltaImagePosY = dy;
    imagePosX += deltaImagePosX;
    imagePosY += deltaImagePosY;
    imagePosXWithScreenWidth = imagePosX - WORLDMAP_CANVAS_WIDTH;
    imagePosYWithScreenHeight = imagePosY - WORLDMAP_CANVAS_HEIGHT;

    // Force image to be horizontally in bounds
    if (imagePosX > 0) {
        var oldImagePosX = imagePosX;
        imagePosX = 0;
        deltaImagePosX -= (oldImagePosX - imagePosX);
    } else if (imagePosXWithScreenWidth <= -WORLDMAP_WIDTH / getWorldmapZoom()) {
        var oldImagePosX = imagePosX;
        imagePosX = -WORLDMAP_WIDTH / getWorldmapZoom() + WORLDMAP_CANVAS_WIDTH;
        deltaImagePosX -= (oldImagePosX - imagePosX);
    }

    // Force image to be vertically in bounds
    if (imagePosY > 0) {
        var oldImagePosY = imagePosY;
        imagePosY = 0;
        deltaImagePosY -= (oldImagePosY - imagePosY);
    } else if (imagePosYWithScreenHeight <= -WORLDMAP_HEIGHT / getWorldmapZoom()) {
        var oldImagePosY = imagePosY;
        imagePosY = -WORLDMAP_HEIGHT / getWorldmapZoom() + WORLDMAP_CANVAS_HEIGHT;
        deltaImagePosY -= (oldImagePosY - imagePosY);
    }

    // Remember current view position
    updateViewRectangle(-1 * imagePosX, -1 * imagePosY);

    // =========================================================================

    return {dx: deltaImagePosX, dy: deltaImagePosY};
}

function moveWorldmapObjects(translationVector) {
    var allWorldmapObjects = getAllWorldmapObjects();
//    console.log("==== WORLDMAP OBJECTS =====");
    for (var key in allWorldmapObjects) {
        var worldmapObject = allWorldmapObjects[key];
//        console.log(worldmapObject);
    }

    // =========================================================================

    var mapLocations = $(".worldmap-location");
    $.each(mapLocations, function (index, object) {
        var mapObject = $("#" + object['id']);
        mapObject.css({
            'top': parseFloat(mapObject.css('top')) + translationVector['dy'],
            'left': parseFloat(mapObject.css('left')) + translationVector['dx']
        });
    });
}
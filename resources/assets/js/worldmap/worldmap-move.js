var MOUSE_DRAG_MODIFIER = 1;

// === Move map / objects ==============================================================

function moveWorldmapImage(event) {
    var dx = event.pageX - mousePreviousPosition.pageX;
    var dy = event.pageY - mousePreviousPosition.pageY;

    // Get current image position
    var imagePosX = worldmap.css('background-position-x');
    var imagePosY = worldmap.css('background-position-y');
    imagePosX = parseFloat(imagePosX.substr(0, imagePosX.length - 2));
    imagePosY = parseFloat(imagePosY.substr(0, imagePosY.length - 2));

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
    } else if (imagePosXWithScreenWidth <= -WORLDMAP_WIDTH / zoom) {
        var oldImagePosX = imagePosX;
        imagePosX = -WORLDMAP_WIDTH / zoom + WORLDMAP_CANVAS_WIDTH;
        deltaImagePosX -= (oldImagePosX - imagePosX);
    }

    // Force image to be vertically in bounds
    if (imagePosY > 0) {
        var oldImagePosY = imagePosY;
        imagePosY = 0;
        deltaImagePosY -= (oldImagePosY - imagePosY);
    } else if (imagePosYWithScreenHeight <= -WORLDMAP_HEIGHT / zoom) {
        var oldImagePosY = imagePosY;
        imagePosY = -WORLDMAP_HEIGHT / zoom + WORLDMAP_CANVAS_HEIGHT;
        deltaImagePosY -= (oldImagePosY - imagePosY);
    }

    // Change image position
    setBackgroundImagePosition(imagePosX, imagePosY);

    // Remember current view position
    updateViewRectangle(imagePosX, imagePosY);

    return {dx: deltaImagePosX, dy: deltaImagePosY};
}

function moveWorldmapObjects(translationVector) {
    var allWorldmapObjects = getAllWorldmapObjects();
    console.log("==== WORLDMAP OBJECTS =====");
    for (var key in allWorldmapObjects) {
        var worldmapObject = allWorldmapObjects[key];
//        console.log(allWorldmapObjects[id]);
        console.log(worldmapObject);
    }

    // =========================================================================

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
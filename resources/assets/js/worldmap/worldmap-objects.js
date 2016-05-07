var _allWorldmapObjects = {};

// =========================================================================

function getAllWorldmapObjects() {
    return _allWorldmapObjects;
}

function addWorldmapObject(worldmapObject) {

    // For every html element, add it to the worldmap canvas
    var htmlElements = worldmapObject.getHtmlElements();
    for (var index in htmlElements) {
        var htmlElement = htmlElements[index];
        getWorldmap().append(htmlElement.getHtml());
    }

    // Add object to the list
    _allWorldmapObjects[worldmapObject.getId()] = worldmapObject;
}


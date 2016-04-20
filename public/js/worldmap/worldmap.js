var WORLDMAP_WIDTH = 3500;
var WORLDMAP_HEIGHT = 3500;

var WORLDMAP_CANVAS_WIDTH = null;
var WORLDMAP_CANVAS_HEIGHT = null;

var WORLDMAP_CANVAS_MARGIN_LEFT = $(".sidebar").width();
var WORLDMAP_CANVAS_MARGIN_TOP = $(".main-header").height();

// =========================================================================

var worldmap = null;

function getWorldmap() {
    if (worldmap != null) {
        return worldmap;
    } else {
        worldmap = $(".worldmap");
        return worldmap;
    }
}

// === Initialize ======================================================================

function initializeWorldmap() {
    var worldmap = $(".worldmap");
    worldmap.css('background-image', 'url("/img/map/map.jpg")');
    worldmap.css('background-size', currentMapImageWidth + "px");
    worldmap.css('background-position-x', '-' + WORLDMAP_INITIAL_VIEW_X + 'px');
    worldmap.css('background-position-y', '-' + WORLDMAP_INITIAL_VIEW_Y + 'px');
}

window.initQueue.push(function () {
    setTimeout(function () {
        WORLDMAP_CANVAS_WIDTH = $(".worldmap").width();
        WORLDMAP_CANVAS_HEIGHT = $(".content-wrapper").height();

        initializeWorldmapZoom();
        initializeWorldmap();
        initializeWorldmapLocations();
        initializeWorldmapEvents();
    }, 80);
});




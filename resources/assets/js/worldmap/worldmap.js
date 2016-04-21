var WORLDMAP_WIDTH = 3500;
var WORLDMAP_HEIGHT = 3500;

var WORLDMAP_CANVAS_WIDTH = null;
var WORLDMAP_CANVAS_HEIGHT = null;

var WORLDMAP_CANVAS_MARGIN_LEFT = null;
var WORLDMAP_CANVAS_MARGIN_TOP = null;

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
}

window.initQueue.push(function () {
    setTimeout(function () {
        WORLDMAP_CANVAS_WIDTH = $(".worldmap").width();
        WORLDMAP_CANVAS_HEIGHT = $(".content-wrapper").height();

        WORLDMAP_CANVAS_MARGIN_LEFT = $(".sidebar").width();
        WORLDMAP_CANVAS_MARGIN_TOP = $(".main-header").height();

        initializeWorldmap();
        initializeWorldmapZoom();
        initializeWorldmapLocations();
        initializeWorldmapEvents();
    }, 80);
});




var WORLDMAP_WIDTH = 3500;
var WORLDMAP_HEIGHT = 3500;

// =========================================================================

window.initQueue.push(function () {
    setTimeout(function () {

        // =========================================================================
        // Define few layout related variables
        WORLDMAP_CANVAS_WIDTH = $(".worldmap").width();
        WORLDMAP_CANVAS_HEIGHT = $(".content-wrapper").height();

        WORLDMAP_CANVAS_MARGIN_LEFT = $(".sidebar").width();
        WORLDMAP_CANVAS_MARGIN_TOP = $(".main-header").height();

        // =========================================================================
        // Create canvas and define view rectangle
        initializeWorldmap();
        initializeWorldmapZoom();

        // Initialize all canvas objects
        initializeWorldmapLocations();

        // Add all listeners
        initializeWorldmapEvents();
    }, 80);
});

// =========================================================================
// =========================================================================
// =========================================================================

var WORLDMAP_CANVAS_WIDTH = null;
var WORLDMAP_CANVAS_HEIGHT = null;

var WORLDMAP_CANVAS_MARGIN_LEFT = null;
var WORLDMAP_CANVAS_MARGIN_TOP = null;

var worldmap = null;

// === Initialize ======================================================================

function initializeWorldmap() {
    var worldmap = $(".worldmap");
    worldmap.css('background-image', 'url("/img/map/map.jpg")');
}

// =========================================================================

function getWorldmap() {
    if (worldmap != null) {
        return worldmap;
    } else {
        worldmap = $(".worldmap");
        return worldmap;
    }
}
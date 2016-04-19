var MAP_WIDTH = 3500;
var MAP_HEIGHT = 3500;

var MAP_CANVAS_WIDTH = null;
var MAP_CANVAS_HEIGHT = null;

var initialMapImageWidth = 1200;
var currentMapImageWidth = null;
var currentMapImageHeight = null;

// =========================================================================

var worldmap = null;

// === Initialize ======================================================================

function initializeWorldmap() {
    var worldmap = $(".worldmap");
    worldmap.css('background-image', 'url("/img/map/map.jpg")');
//    worldmap.css('background-size', '500px 500px');
//    worldmap.css('background-size', MAP_WIDTH_PIXELS + 'px ' + MAP_HEIGHT_PIXELS + 'px');
    worldmap.css('background-size', currentMapImageWidth + "px");
    zoom = MAP_WIDTH / currentMapImageWidth;
    worldmap.css('background-position-x', '-100px');
    worldmap.css('background-position-y', '-100px');
}

window.initQueue.push(function () {
    setTimeout(function () {
        MAP_CANVAS_WIDTH = $(".worldmap").width();
        MAP_CANVAS_HEIGHT = $(".content-wrapper").height();
//        console.log(MAP_CANVAS_WIDTH);
//        console.log(MAP_CANVAS_HEIGHT);
//        console.log(MAP_CANVAS_HEIGHT / MAP_CANVAS_WIDTH);

        currentMapImageWidth = MAP_CANVAS_WIDTH * 2;
        currentMapImageHeight = currentMapImageWidth * MAP_CANVAS_WIDTH / MAP_CANVAS_HEIGHT;

//        console.log(currentMapImageHeight);

        initializeWorldmap();
        initializeWorldmapLocations();
        initializeWorldmapEvents();
    }, 80);
});




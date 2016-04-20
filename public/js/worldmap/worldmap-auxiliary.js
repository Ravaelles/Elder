function gameLog(message) {
    $(".game-log p").css('opacity', '0.7');

    $(".game-log").prepend("<p style='display: none' class='game-log-invisible'><span class='dot'>•</span> "
            + message + "</p>");

    $(".game-log .game-log-invisible").slideDown(700);
}

function gameMessage(text, forceOneMessage, color) {
    if (typeof forceOneMessage == 'undefined') {
        forceOneMessage = true;
    }
    if (color) {
        color = "color: " + color;
    }

    var gameMessages = $(".game-messages");
    if (forceOneMessage) {
        gameMessages.html("");
    }

    gameMessages.prepend("<div class='game-message' style='width: " + WORLDMAP_CANVAS_WIDTH + "px;"
            + color + "'>" + text + "</div>");
}

// === Totally auxiliary ======================================================================

function coordinatesToString(coordinates) {
    if ('canvasX' in coordinates) {
        return "[" + coordinates['canvasX'] + "," + coordinates['canvasY'] + "]";
    } else {
        return "[" + coordinates['mapX'] + "," + coordinates['mapY'] + "]";
    }
}
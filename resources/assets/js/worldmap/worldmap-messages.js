var _WORLDMAP_MESSAGE_SHOW_TIME = 2000;
var _WORLDMAP_MESSAGE_DIM_INTERVAL = 100;

var _worldmapMessageFirstFreeId = 10000;

// =========================================================================

function gameLog(message) {
    $(".game-log p").css('opacity', '0.7');

    $(".game-log").prepend("<p style='display: none' class='game-log-invisible'><span class='dot'>•</span> "
            + message + "</p>");

    $(".game-log .game-log-invisible").slideDown(700);
}

function worldmapMessageForever(text, uniqueForeverMessageId, color) {
    if (typeof uniqueForeverMessageId == 'undefined') {
        console.error("Did not pass worldmapMessageForever unique id!");
        return;
    }
    return worldmapMessage(text, color, uniqueForeverMessageId);
}

function worldmapMessage(text, color, uniqueForeverMessageId) {
    if (color) {
        color = "color: " + color;
    }

    // Define message id
    var messageId = 'game-message-' + (isDefined(uniqueForeverMessageId) ?
            uniqueForeverMessageId : _worldmapMessageFirstFreeId++);

    // =========================================================================
    // Remove previous message if needed

    if (uniqueForeverMessageId) {
        var message = $("#" + messageId);
        if (message.length > 0) {
            message.text(text);
            return;
        }
    }

    // =========================================================================
    // Add html element of message
    $(".game-messages").append("<div class='game-message' id='" + messageId + "' style='width: "
            + WORLDMAP_CANVAS_WIDTH + "px;" + color + ";opacity:1.0'>" + text + "</div>");

    // =========================================================================
    // Decrease message's opacity with time
    if (!uniqueForeverMessageId) {
        setTimeout(function () {
            _dimMessageWithTime(messageId);
        }, _WORLDMAP_MESSAGE_SHOW_TIME);
    }
}

// =========================================================================

function _dimMessageWithTime(messageId) {
    var message = $("#" + messageId);
    var opacity = message.css('opacity');
    if (opacity <= 0) {
        var hideTime = 400;
        message.hide(hideTime);
        setTimeout(function () {
            message.remove();
        }, hideTime);
    } else {
        message.css('opacity', message.css('opacity') - 0.03);
        setTimeout(function () {
            _dimMessageWithTime(messageId);
        }, _WORLDMAP_MESSAGE_DIM_INTERVAL + opacity * 100);
    }
}
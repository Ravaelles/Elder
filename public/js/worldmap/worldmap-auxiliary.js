function gameLog(message) {
    $(".game-log p").css('opacity', '0.7');

    $(".game-log").prepend("<p style='display: none' class='game-log-invisible'><span class='dot'>•</span> "
            + message + "</p>");

    $(".game-log .game-log-invisible").slideDown(700);
}


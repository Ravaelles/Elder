// =========================================================
// === GENERIC =============================================
// =========================================================

/**
 * Shows popup message with OK|Cancel buttons. Best to use before deleting objects, on Delete button.
 * @param {type} message
 * @returns {Boolean}
 */
function confirmDelete(message, disallowPleaseWaitOverlay) {
    if (!message) {
        message = "Are you sure you want to delete?";
    }

    if (confirm(message)) {
        if (!disallowPleaseWaitOverlay) {
            showPleaseWait();
        }
        return true;
    }
    else {
        return false;
    }
}

/**
 * Displays overlay with "Please wait" text. Based on bootstrap modal. Contains animated progress bar.
 */
function showPleaseWait() {
    var modalLoading = '<div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false role="dialog">\
        <div class="modal-dialog">\
            <div class="modal-content">\
                <div class="modal-header">\
                    <h4 class="modal-title">Please wait...</h4>\
                </div>\
                <div class="modal-body">\
                    <div class="progress">\
                      <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"\
                      aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px">\
                      </div>\
                    </div>\
                </div>\
            </div>\
        </div>\
    </div>';
    $(document.body).append(modalLoading);
    $("#pleaseWaitDialog").modal("show");
}

/**
 * Hides "Please wait" overlay. See function showPleaseWait().
 */
function hidePleaseWait() {
    $("#pleaseWaitDialog").modal("hide");
}

function scrollToElement(selector, miliseconds) {
    if (!miliseconds) {
        miliseconds = 1500;
    }
    $('html, body').animate({
        scrollTop: $(selector).offset().top
    }, miliseconds);
}

function appendErrorToBody(message) {
    $(document.body).append("<div style='background-color: #a22l color: white;'>" + message + "</div>");
}

function setCookie(cookieName, value, expireSecond) {
    var d = new Date();
    d.setTime(d.getTime() + (expireSecond * 1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cookieName + "=" + value + "; " + expires;
}

function getCookie(cookieName) {
    var name = cookieName + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ')
            c = c.substring(1);
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function rand(min, max) {
    return Math.floor((Math.random() * max) + min);
}

function randArray(arr) {
    return arr[Math.floor(Math.random() * arr.length)];
}

function randElem(arr) {
    return arr[Math.floor(Math.random() * arr.length)];
}

// =========================================================
// ===== SPECIFIC ==========================================
// =========================================================

function typeSounds() {
    $('input').keyup(function (e) {
        playTypeSound();
    });
    $("label").click(function () {
        playTypeSound();
    });
    $("button").click(function () {
        playTypeSound();
    });
    $(".create-account-button").click(function () {
        playTypeSound();
    });
}

function playTypeSound() {
    soundIndex = Math.floor((Math.random() * 5) + 1);
    $(document.body).append('<audio controls autoplay style="display: none" id="audio"><source src="/sound/terminal/type' + soundIndex + '.mp3" type="audio/mpeg"></audio>');
}
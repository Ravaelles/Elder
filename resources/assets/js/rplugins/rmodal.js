$(document).ready(function () {

    // Handle opening RModal if anchor is present
//    showRModalFromUrlHashIfNeeded();

    // Handle clicks in modal activation buttons
    $(".rmodal").click(function (e) {
        _RModal_activateButtonClicked(e);
    });

});

// =========================================================================

// Handle opening RModal if anchor is present
function showRModalFromUrlHashIfNeeded() {
    var anchorName = window.location.hash;
    if (anchorName.length > 1 && window.location.pathname.indexOf('/login') == -1) {
        anchorName = anchorName.substring(1);
        if (!anchorName.startsWith('tab-')) {
            showRModal(anchorName);
        }
    }
}

// Opens RModal window identified by given anchorName url hash.
function showRModal(anchorName) {

    // Display please wait overlay
    showPleaseWait();

    // Ensure RModal window structure exists
    ensureRModalWindowStructureExists();

    // Update window hash url
    window.location.hash = anchorName;

    // Define url for the request
    fullUrl = location.href.replace(location.hash, "") + "/" + anchorName;

    // Ajax load content from request url
    nicelyLoadPOST(fullUrl, '#rmodal-wrapper', function (data) {

        // Show modal window on load
        $('.rmodal').modal({
            keyboard: true,
            show: true
        });

        // Handle closing modal event
        $('#rmodal').on('hidden.bs.modal', function (e) {

            // Update window hash url
            window.location.hash = "";
        });
    });
}

// Closes all RModals
function closeRModal() {
    $('.rmodal-wrapper').modal('hide');
}

// Closes all modals
function closeModal() {
    $('.modal').modal('hide');
}

// Create bootstrap modal html if not present
function ensureRModalWindowStructureExists() {
    if (!document.getElementById("rmodal")) {
        $("body").append("<div class='rmodal-wrapper' id='rmodal-wrapper'></div>");
    }
}

// Manually add listener to given jQuery selector so RModal can work correctly
// in pages loaded dynamically
function addRModalListener(selector) {
    $(selector).click(function (e) {
        _RModal_activateButtonClicked(e);
    });
}

// =========================================================================

// All actions to display RModal window
function _RModal_activateButtonClicked(e) {

    // Disable hyperlink actions
    e.preventDefault();

    // Define href
    var href = null;
    var thisObject = $(this);
    if (isWindow(thisObject.get(0))) {
        href = e.target.href;
        href = href.substring(href.indexOf('#'));
    } else {
        href = thisObject.attr('href');
    }

    // Define anchor (hash) name
    var anchorName = href.substring(1);
    anchorName = anchorName.replace(window.location, "");

    // Show proper RModal based on
    showRModal(anchorName);

    // Hide all popovers
    $('[data-toggle="popover"]').popover('hide');
}

// Auxiliary functions that returns true if given object is instance of Window
function isWindow(obj) {
    if (typeof (window.constructor) === 'undefined') {
        return obj instanceof window.constructor;
    } else {
        return obj.window === obj;
    }
}


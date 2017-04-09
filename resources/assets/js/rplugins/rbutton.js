$(document).ready(function () {
    $(".ajax-button-status").click(function (element) {
//        ajaxButtonClicked(element);
        ajaxButtonStatusClicked(element);
    });
});

// =========================================================================

function ajaxButtonStatusClicked(element) {
    var selectorLoadTo = $(element);
    if (selectorLoadTo == null) {
        console.log("Invalid selector for element");
        console.log(element);
    }

    var url = selectorLoadTo.attr('url');
    if (url == null || url.length == 0) {
        console.log("Invalid url for element");
        console.log(element);
        return;
    }

    $.post(url,
            {'_token': $('meta[name="csrf-token"]').attr('content')},
            function (response) {
                $(selectorLoadTo).val(response);
            })
            .fail(function (data) {
                console.log(data);
                if (!hideErrorAlert) {
                    alert("Error has occured\n\nCheck your internet connection and try again after few seconds");
                }
            })
            .always(function () {

                // Hide please wait overlay
//                hidePleaseWait();
            });
}


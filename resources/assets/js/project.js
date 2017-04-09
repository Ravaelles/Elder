
// Laravel CSRF in all ajax forms
$.ajaxSetup({
    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
});

initUiListeners();

// Process all listeners to be run after window is loaded
$.each(window.initQueue, function (i, fn) {
    fn();
});

// =========================================================================

function initUiListeners() {

    // Bootstrap tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({
            html: true
        });
    })

    // Bootstrap popover
    //        $(function () {
    //            $('[data-toggle="popover"]').popover({
    //                html: true
    //            });
    //        })

    // WebUI popover
    $('*[data-toggle="popover"]').webuiPopover({
        title: '',
        placement: 'bottom',
        onShow: function () {
            initUiListeners();
        }
    });

    // Sort tables - TableSorter plugin
    $(".tablesorter").tablesorter({
        'cssAsc': "th.headerSortUp{background-image: url(/img/ui/tablesorter/small_asc.gif); background-color: #3399FF;}"
    });

    // Fix
    setTimeout(function () {
        $(".fill-content").css('width', $(".content").width());
        $(".fill-content").css('height', $(".content-wrapper").height());
    }, 50);
}
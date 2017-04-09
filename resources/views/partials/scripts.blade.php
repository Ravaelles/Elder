<script src="/js/compressed/base.min.js" type="text/javascript"></script>
<!--<script src="/js/compressed/rplugins.min.js" type="text/javascript"></script>-->

@if (array_key_exists('load-engine-script', View::getSections()))
<!-- Engine scripts -->
<script src="/js/compressed/engine.min.js" type="text/javascript"></script>
@endif

@if (array_key_exists('load-worldmap-script', View::getSections()))
<!-- Worldmap scripts -->
<script src="/js/compressed/worldmap.min.js" type="text/javascript"></script>
@endif

<!-- Engine & game scripts merged -->
<script src="/js/compressed/app.min.js" type="text/javascript"></script>

@stack('scripts')

<!-- SHOULD BE MERGED -->

<!-- Sorts tables with jQuery -->
<script src="/plugins/TableSorter/jquery.tablesorter.min.js" type="text/javascript"></script>

<?php
//$baseDir = public_path('js');
//$scriptFiles = [];
//foreach (scandir($baseDir) as $file) {
//    if (starts_with($file, '.')) {
//        continue;
//    }
//    $path = $baseDir . '/' . $file;
//    if (is_dir($path)) {
//        foreach (scandir($path) as $file) {
//            if (starts_with($file, '.')) {
//                continue;
//            }
//            $scriptFiles[] = str_ireplace(base_path() . '/public', "", $path) . '/' . $file;
//        }
//    } else {
//    }
//}
//foreach ($scriptFiles as $scriptFile) {
//    echo "<script src='$scriptFile' type='text/javascript'></script>";
//}
?>

<script>
    //<!-- Pass CSRF token to every ajax request -->
    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
    });

    // Tooltips
    window.initQueue.push(function () {
        // <!-- Bootstrap tooltips -->
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                html: true
            });
        })
        $(function () {
            $('[data-toggle="popover"]').popover({
                html: true
            });
        })
        
        // Sort tables - TableSorter plugin
        $(".tablesorter").tablesorter({
            'cssAsc': "th.headerSortUp{background-image: url(/img/ui/tablesorter/small_asc.gif); background-color: #3399FF;}"
        }); 
    });
    
    // Fill content to the maximum
    window.initQueue.push(function () {
        setTimeout(function () {
            $(".fill-content").css('width', $(".content").width());
            $(".fill-content").css('height', $(".content-wrapper").height());
        }, 50);
    });

    //<!-- Process all listeners to be run after window is loaded -->
    $.each(window.initQueue, function (i, fn) {
        fn();
    });
</script>

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<!--<link rel="stylesheet" href="'/css/font-awesome.min.css">-->
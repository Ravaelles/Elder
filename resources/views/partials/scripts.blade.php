<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- jQuery wheel -->
<script src="/plugins/jQuery-wheel/jquery.mousewheel.min.js" type="text/javascript"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="/js/app.min.js" type="text/javascript"></script>
<!-- Noty - nice notifications -->
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>-->
<!-- Project specific scripts -->
<script src="/js/project.js" type="text/javascript"></script>
<!-- All engine scripts merged -->
<script src="/js/all.js" type="text/javascript"></script>

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

<!-- HQ scripts -->
<script src="/assets-hq/js/all.js" type="text/javascript"></script>

<!-- jQuery UI -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/assets-hq/js/bootstrap.min.js" type="text/javascript"></script>

@include('hq.scaffold.layout.scaffold-notifications')

@stack('scripts')

<script>
    $(document).ready(function () {
<!-- Process all listeners to be run after window is loaded -->
        $.each(window.initQueue, function (i, fn) {
            fn();
        });

<!-- Bootstrap tooltips -->
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                html: true
            });
        });

        $(".hq-content").animate({opacity: 1}, 500, 'linear');
    });
</script>
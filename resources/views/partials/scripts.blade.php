<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>
<!-- Project specific scripts -->
<script src="{{ asset('/js/project.js') }}" type="text/javascript"></script>

<script>
    //<!-- Pass CSRF token to every ajax request -->
    $.ajaxSetup({
       headers: { 'X-CSRF-Token': $('meta[name=_token]').attr('content')}
    });

    //<!-- Process all listeners to be run after window is loaded -->
    $.each(window.initQueue, function (i, fn) {
        fn();
    });
</script>
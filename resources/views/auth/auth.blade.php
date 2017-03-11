<!DOCTYPE html>
<html>

@include('partials.head')

@yield('content')

<script>
    //<!-- Pass CSRF token to every ajax request -->
    $.ajaxSetup({
       headers: { 'X-CSRF-Token': $('meta[name=_token]').attr('content')}
    });

    //<!-- Process all listeners to be run after window is loaded -->
    $.each(window.initQueue, function (i, fn) {
        fn();
    })
</script>

</html>
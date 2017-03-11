<?php
// FOR TESTS - SHOW
//session([
//    'flash_notification.message' => 'Changes have been saved!',
//    'flash_notification.level' => 'success'
//]);
//dump(session()->all());
?>

@if (session()->has('flash_notification.message'))
<div class="notification notification-{{ session('flash_notification.level') }}" style="display:none">

    <div class="notification-text">
        {!! session('flash_notification.message') !!}
    </div>

    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
        <i class="fa fa-times"></i>
    </button>

</div>

<?php
session(['flash_notification' => null]);
?>

@push('scripts')
<script type="text/javascript">
    function closeNotification(notification, animationLength) {
        $(notification).animate({"marginRight": "-300px"}, {duration: animationLength});
        $(notification).fadeOut(1000);
    }

    $(document).ready(function () {
        setTimeout(function () {
            $(".notification").fadeIn(600);
        }, 200);
        setTimeout(function () {
            closeNotification($(".notification"), 2500);
        }, 6000);
        $(".notification").click(function () {
            closeNotification(this, 1200);
        });
    });
</script>
@endpush
@endif
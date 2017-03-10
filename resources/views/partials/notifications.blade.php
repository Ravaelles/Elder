{!! Notification::showAll() !!}
<?php
//<!--@ if(Notifications::all()->has())
//<div class="notifications center-block" style="display: none">
//     foreach (Notifications::all()->get() as $message)
//    <? php
//    $notificationClass = ($message['type'] === 'important' ? "warning" : $message['type']);
//
//    if ($message['type'] === 'alert') {
//        $message['type'] = "warning";
//    }
//
//    $notificationHeader = ucwords($message['type']);
//    $notificationHeader = '<i class="icon fa fa-warning"></i>&nbsp; &nbsp; ' . $notificationHeader;
//    ? >
//    <div class="callout callout-{ { $notificationClass }}">
//        <h4>{ !! $notificationHeader !!}!</h4>
//        { !! $message['message'] !!}
//    </div>
//    @ endforeach
//</div>
//@ endif-->
?>
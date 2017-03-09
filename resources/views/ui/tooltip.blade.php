<?php
/**
 * This script allows to display bootstrap tooltip with some enhanced functionality like 
 * 'align' => justify|left
 * 
 * Example usage:
 * @include('partials/ui/tooltip', [
 *     'message' => 'Hello, this is your tooltip'
 * ])
 */
if (!empty($align) || strlen($message) > 50) {
    if (empty($align)) {
        $align = '';
    }

//    if ($align === 'justify' || strlen($message) > 50) {
//        $message = "<div style=\'text-align: justify\'>$message</div>";
//    } else if ($align === 'left') {
//        $message = "<div style=\'text-align: left\'>$message</div>";
//    }
}
?> 
data-toggle="tooltip" 
data-placement="{!! $location or 'bottom' !!}" 
title="{!! $message or '' !!}"
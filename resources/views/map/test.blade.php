<?php
// === Parameters ==========================================================
$disableContentHeader = true;
$mapDebug = false;
//$mapDebug = true;
// ========================================================================= 
?>

@extends('fullscreen')

@section('sidebar-collapse')
sidebar-collapse
@endsection

@section('main-content')

<div style="width: 100%; height: 100%;">
    <img src="/img/world/test/background.jpg" style="position:absolute; z-index:1" />
    <img src="/img/world/people/person-right.gif" style="position:absolute; z-index:9; top:300px; left:300px; 
         width:22px; height:35px;" class="person" />
</div>


<script type="text/javascript">
    window.initQueue.push(function() {
        console.log((getLeft() + "px"));
        walkRight();
        setTimeout(function() {
            walkRight();
        }, 2500);
    }); 
    
    function walkRight() {
        $(".person").animate({
            left: (getLeft() + "px")
        }, 2000, "linear");
    }
    
    function getLeft() {
        var left = parseInt($(".person").css("left").slice(0, -2));
        return (left + 70);
    }
</script>

@endsection
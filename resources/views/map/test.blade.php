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
    <img src="/img/world/people/right-stand.png" style="position:absolute; z-index:9; top:300px; left:300px; 
         width:22px; height:35px;" class="person" />

    <div class="" style="position:absolute; top:300px; left:300px; border-bottom:1px solid red; width:70px; z-index:99">
    </div>

</div>


<script type="text/javascript">
    var people = [
        {x:300, y:300}
    ];
    
    window.initQueue.push(function() {
//        setTimeout(function() {
//            walkRight();
//            setTimeout(function() {
//                walkRight();
//            }, 500);
//        }, 500);
        for (var i in people) {
            var person = people[i];
            createElement_person(person);
        }

        setTimeout(function() {
            walkRight();
            walkRight();
            walkRight();
            setTimeout(function() {
                walkRight();
                walkRight();
                walkRight();
            }, 50);
        }, 500);
    }); 
    
    function walkRight() {
        var selector = $(".person");
        selector.attr("src", "/img/world/people/right-walk.gif");
        selector.animate({
            left: (getLeft() + "px")
        }, 500, "linear", function() {
            selector.attr("src", "/img/world/people/right-stand.png");
        });
    }
    
    function getLeft() {
        var left = parseInt($(".person").css("left").slice(0, -2));
        return (left + 70);
    }
</script>

@endsection
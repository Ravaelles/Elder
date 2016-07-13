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

<script type="text/javascript">
    var world = {!! $worldJson !!};
</script>

<div class="map-canvas {{ $mapDebug ? 'map-debug' : '' }} no-select" id="map-canvas">
    <div class="game-messages"></div>

    @include('map.content')
</div>

<!-- Get script that runs RMap engine -->
<script type="text/javascript" src="/js/compressed/rmap-engine.min.js"></script>

@endsection
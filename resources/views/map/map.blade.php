@extends('fullscreen')

<?php
$disableContentHeader = true;
$mapDebug = false;
?>

@section('sidebar-collapse')
sidebar-collapse
@endsection

@section('main-content')

<script type="text/javascript">
    var world = {!! $worldJson !!};
</script>

<div class="map-canvas {{ $mapDebug ? 'map-debug' : '' }} no-select" id="map-canvas">
    <!--<div class="map-canvas map-debug no-select" id="map-canvas">-->
    <div class="game-messages"></div>

    @include('map.content')
</div>

@endsection
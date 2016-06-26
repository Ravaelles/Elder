@extends('app')

<?php $disableContentHeader = true; ?>

@section('main-content')

<script type="text/javascript">
    var world = {!! $worldJson !!};
</script>

<div class="map-canvas no-select" id="map-canvas">
    <div class="game-messages"></div>

    @include('world.content')
</div>

<style>
    .map-object {
        position: absolute;
        margin-top: 50px;
        margin-left: 230px;
        width: 80px;
        height: 80px;
        /*border: 1px solid rgba(255, 0, 0, 0.4);*/
    }
</style>

@endsection
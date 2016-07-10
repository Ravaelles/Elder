@extends('app')

<?php $disableContentHeader = true; ?>

@section('sidebar-collapse')
sidebar-collapse
@endsection

@section('main-content')

<script type="text/javascript">
    var world = {!! $worldJson !!};
</script>

<div class="map-canvas no-select" id="map-canvas">
    <div class="game-messages"></div>

    @include('map.content')
</div>

@endsection
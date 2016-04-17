@extends('app')

<?php $disableContentHeader = true; ?>

@section('main-content')
<div class="worldmap fill-content"></div>

@include('worldmap.locations')

<style>
    .worldmap {
        overflow: hidden;
        width: 100%;
        min-width: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        background-image: url("@image('map/map.jpg')");
        background-repeat: no-repeat;
        background-size: 250% 250%;
        background-position-x: 10%;
        background-position-y: 10%;
    }

    .worldmap * {
        cursor: pointer !important;
    }
</style>

<!-- JavaScript -->
<script src="/js/worldmap/worldmap.js" type="text/javascript"></script>
@endsection
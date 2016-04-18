@extends('app')

<?php $disableContentHeader = true; ?>

@section('main-content')
<div class="worldmap fill-content"></div>

<!-- Dynamic stylesheet for the worldmap -->
<!--<style id="worldmap-location-stylesheet">
    .worldmap-location {
        width: 55px;
        height: 55px;
    }
</style>-->

<!-- Load locations -->
@include('worldmap.locations')

@endsection
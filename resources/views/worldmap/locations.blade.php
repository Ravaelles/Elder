@foreach ($cities as $city)
<?php
$top = $city->location['y'] * 10;
$left = $city->location['x'] * 10;
?>
<div class="worldmap-location noselect" 
     id="worldmap-location-{{ $city->getID() }}"
     style="top: {{ $top }}px; left: {{ $left }}px;">{{ $city->name }}</div>
@endforeach

<style>
    .worldmap-location {
        position: absolute;
        width: 55px;
        height: 55px;
        text-align: center;
        padding-top: 20px;
        font-size: 10px;
        color: #0e0;
        background-color: rgba(0, 255, 0, 0.2);
        border: 2px solid #0d0;
        border-radius: 50%;
    }
</style>
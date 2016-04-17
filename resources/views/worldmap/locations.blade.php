@foreach ($cities as $city)
<?php
$top = $city->location['y'];
$left = $city->location['x'];
?>
<div class="worldmap-location" 
     id="worldmap-location-{{ $city->getID() }}"
     style="top: {{ $top }}px; left: {{ $left }}px;"><label class="noselect">
        {{ $city->name . ' ' . json_encode($city->location) }}
    </label></div>
@endforeach

<style>
    .worldmap-location label {
        margin-top: 38px;
    }
</style>
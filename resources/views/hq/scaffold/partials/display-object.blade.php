<?php
$mode = strtolower($mode);
$isDisplayTable = $mode !== 'list';

$isModeView = $mode === 'view';
$isFieldEditable = ($mode === 'edit' || $mode === 'create');
?>

@if ($isDisplayTable)
<table class="table table-condensed table-striped">
    <tbody>
        @endif

@foreach ($fields as $fieldName => $fieldArray)
@include('hq.scaffold.partials.display-field')
@endforeach

    @if ($isDisplayTable)
    </tbody>
</table>
@endif
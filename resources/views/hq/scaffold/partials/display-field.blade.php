<?php
if (!isset($rawObject)) {
    $rawObject = $model;
}

$fieldValue = @$rawObject->$fieldName;
$fieldValueActual = @$rawObject->$fieldName;
$isSelect = $rawObject->isFieldSelect($fieldArray);
if ($isSelect) {
    $selectOptions = $scaffoldedObject[$fieldName];
}

// === Define how field should be displayed =================================

$shouldDisplayAsFormGroup = $mode !== 'list';

// =========================================================================
// === DISPLAY =============================================================
// =========================================================================
?>

{{-- ########## Display as FORM GROUP ############ --}}
@if ($shouldDisplayAsFormGroup)

<div class="form-group">
    <label for="{{ $fieldName }}">
        {!! $mode === 'view' ? '<b>' : '' !!}
            {{ ucfirst($fieldName) }}:
            {!! $mode === 'view' ? '</b>' : '' !!}
    </label>

    @include('hq.scaffold.partials.display-field-value')
</div>

@else

{{-- ########## Display as TABLE ############ --}}

<td>
    @include('hq.scaffold.partials.display-field-value')
</td>

@endif

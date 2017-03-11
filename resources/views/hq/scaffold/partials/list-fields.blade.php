@foreach ($fields as $fieldName => $fieldArray)
<?php
$fieldName = !empty($fieldArray['label']) ? $fieldArray['label'] : $fieldName;
?>
<th>
    {!! ucfirst($fieldName) !!}
</th>
@endforeach
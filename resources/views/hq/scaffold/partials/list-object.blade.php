@foreach ($fields as $fieldName => $fieldArray)
<td>
    <?php
    $fieldValue = $scaffoldedObject->$fieldName;
    if (isset($fieldArray['select'])) {
        foreach ($fieldArray['select'] as $value => $option) {
            if ($fieldValue == $value) {
                $fieldValue = $option;
                break;
            }
        }
    }
    ?>
    {!! !empty($fieldValue) ? $fieldValue : "<font color='#ccc'>null</font>" !!}
</td>
@endforeach
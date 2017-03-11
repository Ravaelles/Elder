@if ($isFieldEditable)
<input type="text" name="{{ $fieldName }}" value="{{ $fieldValueActual }}" 
       class="form-control {{ $isModeView ? 'disabled' : '' }}" {{ $isModeView ? 'disabled' : '' }}>
@else
{!! $fieldValueActual !!}
@endif
@if ($isFieldEditable)

<select name="{{ $fieldName }}" class="form-control {{ $isModeView ? 'disabled' : '' }}" 
        {{ $isModeView ? 'disabled' : '' }}>
    @foreach ($selectOptions as $value => $option)

    @if ($value === "" && $option === "")
    <option value="">--- Select ---</option>
    @else
    <option value="{{ $value }}" {{ $value === $fieldValueActual ? 'selected="selected"' : '' }}>
        {!! $option !!}
    </option>
    @endif

    @endforeach
</select>

@else

@if (!empty($fieldValueActual))
@foreach ($selectOptions as $value => $option)
@if ($value === $fieldValueActual)
{!! \App\Helpers\UIHelper::valueOrNoneString($option) !!}
@endif
@endforeach
@endif

@if (empty($fieldValueActual))
{!! \App\Helpers\UIHelper::valueOrNoneString($fieldValueActual) !!}
@endif

@endif
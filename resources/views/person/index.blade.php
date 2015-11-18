@extends('app')

@section('htmlheader_title')
- Home
@endsection

@section('contentheader_title')
@breadcrumbs('wasteland', 'Wasteland', 'village', 'Village', 'Home')
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-fallout">

            @if (count($persons) > 0)
            <table class="table table-borderless-header table-fallout persons">
                <thead>
                <th></th>
                <th></th>
                <th>Name</th>
                <th class="th-special-stat">S</th>
                <th class="th-special-stat">P</th>
                <th class="th-special-stat">E</th>
                <th class="th-special-stat">C</th>
                <th class="th-special-stat">I</th>
                <th class="th-special-stat">A</th>
                <th class="th-special-stat">L</th>
            </thead>

                <tbody>
                    @foreach ($persons as $person)
                    <tr class="">
                        <td class="centered borderless-cell" style="width: 120px;">
                            <a class="btn btn-sm btn-green" href="{{ route('person.show', ['name' => str_slug($person->client_company), 'id' => $person->id]) }}">Show</a>
                        </td>
                        <td class="left borderless-cell" style="width: 50px;">
                            {!! $person->image !!}
                        </td>
                        <td class="left">
                            {{ $person->name }}
                        </td>
                        <td class="td-special-stat">
                            {{ $person->SPECIAL->strength }}
                        </td>
                        <td class="td-special-stat">
                            {{ $person->SPECIAL->perception }}
                        </td>
                        <td class="td-special-stat">
                            {{ $person->SPECIAL->endurance }}
                        </td>
                        <td class="td-special-stat">
                            {{ $person->SPECIAL->charisma }}
                        </td>
                        <td class="td-special-stat">
                            {{ $person->SPECIAL->intelligence }}
                        </td>
                        <td class="td-special-stat">
                            {{ $person->SPECIAL->agility }}
                        </td>
                        <td class="td-special-stat">
                            {{ $person->SPECIAL->luck }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!--{ !! $persons->appends(\Input::except('page'))->render() !! }-->
            @else
            All of your tribemen are extinct like damned mammuts <img src="/img/emots/sad.png" class="emoticon" />
            @endif
        </div>
    </div>
</div>
@endsection
